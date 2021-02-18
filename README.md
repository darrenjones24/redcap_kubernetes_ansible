Role Name
=========
A reusable role for Redcap services


Upgrade
-------

Download Redcap Zip file from:
https://community.projectredcap.org/page/download.html

(use the install rather than the upgrade zip)
Place the file in files/build
run:
```Docker build . -t uostechops.azurecr.io/redcap:version```

```Docker login```

```Docker push -t uostechops.azurecr.io/redcap:version```

edit the deployment:

```kubectl set image deployment.v1.apps/redcap-x redcap=uostechops.azurecr.io/redcap:version --record````

see rollout status

```kubectl rollout status deployment/nginx-deployment```

```kubectl rollout history deployment.v1.apps/redcap-x --revision=2```

undo deployment

```kubectl rollout undo deployment.v1.apps/redcap-x```

Requirements
------------

Azure Storage Account
Azure MYSQL Database
Kubernetes Cluster
Container Registry
Redcap Container

Role Variables
--------------

name_of_host
tls_server
tls_server_path
tls_intermediate_certificate
ansible_user
azurestorageaccountname
azurestorageaccountkey
service_namespace
service_name
servicename_service
servicename_port
servicename_gateway
service_url1
service_url2

### stored in ansible vault redcap_db_credentials
redcap_db_host
redcap_db_name
redcap_db_username
redcap_db_password
redcap_salt


Dependencies
------------
https://raw.githubusercontent.com/ansible-collections/azure/dev/requirements-azure.txt

Kubectl must be installed and configured on the local host

The role attempts to pull the TLS private and public keys from a centralised certificates from a centralised certificate server called $tls_server_fqdn

Example Playbook
----------------


- name: Deploy Redcap (Psychology) 
  environment:
    PATH: "{{ ansible_env.PATH }}:/usr/local/bin"
  hosts: localhost
  vars:
    name_of_host: hostname  # for purpose of getting certificate
    tls_server: tls_server_fqdn 
    tls_server_path: /usr/local/openssl/certs
    tls_intermediate_certificate: /usr/local/openssl/certs/RootCertificates/QuoVadis_Europe_EV_SSL_CA_G1.crt
    ansible_user: configuration_manager
    service_namespace: redcap
    service_name: redcap
    servicename_service: redcap-svc
    servicename_port: redcap-prt
    servicename_gateway: redcap-gwy
    service_url1: redcap.hostname
    service_url2: redcap.hostname2
    image_name: repository/redcap:10.6.4
    pv_name: redcap--pv
    azure_share_name: redcap-share
    redcap_db_credentials: !vault |
          $ANSIBLE_VAULT;1.1;AES256
          xxxxxxxx
  roles:
    - { role: uos.k8s_redcap }

License
-------

GPLv3

Author Information
------------------

Darren Jones Dec 2020
