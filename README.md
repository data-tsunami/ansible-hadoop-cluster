Ansible playbook for my Hadoop cluster
--------------------------------------

Setup a Hadoop 1.2.1 cluster on CentOS 6.4 servers.

### Playbooks

#### site.yml

The `site.yml` playbook starts with a just installed CentOS 6.4 (you need ssh access + sudo working) and:

- configures each nodes to use a http proxy to speedup installs of RPMs (to be kind with mirrors and do faster deploys)
- setups /etc/fstab and mounts a NFS share in each node (it's up to you to setup the NFS server, or see `site-infrastructure.yml`) to centralize Hadoops logs
- install Java and Hadoop on each node
- format the name node.

To make this work, you must have:

 - a NFS server: you can setup the NFS server, and export a share as read-write, or see `site-infrastructure.yml`
 - Hadoop binaries in the ./files/ directory (see ./files/README.txt)
 - your hosts defined in `hosts` file (see `hosts.example` as reference)
 - your settings customized in `local.yml` file (see `local.yml.example` as reference)

### site-infrastructure.yml

The `site-infrastructure.yml` playbook does:

- crates /srv/nfs and setup the NFS services
- exports /srv/nfs
- uploads a KickStart file to the Apache's document root (FYI, KickStart allows unattended install of CentOS)

## What is working

- works against CentOS 6.4
- set YUM mirror and proxy
- disable fastestmirror YUM plugin
- setup NFS server & exports
- setup NFS client & fstab (to share logs)
- install JDK
- install Hadoop
- setup Hadoop (files on conf/)
- format the namenode
- start/stop Hadoop cluster

### TODO

- Make NFS optional
- Install proxy server on infrastructure server
- Setup /etc/hosts to avoid the need of a DNS server
- Setup init scripts for Hadoop
- Initial setup of ssh keys and sudo? (don't know if possible, since it's required for Ansible)

### Some ideas

- add monitoring (ej: nagios, munin, ganglia, etc.)
- create virtual machines with libvirt
- setup DNS? (on 'infrastructure' server)
- setup secondary DNS on all the nodes, to speedup name resolutions
- more Hadoop-related services (Hue, Pig, Hive, etc.)

# How to install

    $ git clone https://github.com/data-tsunami/ansible-hadoop-cluster.git
    $ cd ansible-hadoop-cluster/
    $ virtualenv -p python2.7 virtualenv
    $ . virtualenv/bin/activate
    $ pip install ansible

# How to use

#### Setup Ansible files for your deploy

    $ cp local.yml.example local.yml
    $ vi local.yml
    $ cp hosts.example hosts
    $ vi hosts

#### To disable ssh host key checking:

    $ export ANSIBLE_HOST_KEY_CHECKING=False

#### Setup the infrastructure server:

    $ ansible-playbook -i hosts site-infrastructure.yml

#### Setup the Hadoop cluster:

    $ ansible-playbook -i hosts site.yml

#### To start Hadoop:

    $ ansible-playbook -i hosts -v start-hadoop.yml

#### Test the cluster:

    $ ansible-playbook -i hosts -v check-hadoop.yml

#### To stop Hadoop:

    $ ansible-playbook -i hosts -v stop-hadoop.yml

#### And, to run a command on all the nodes:

    $ ansible -i hosts nodes -m command -a "sudo du -hsx /srv/hadoop"

### Tag: hadoopconf

The `hadoopconf` allows to quickly reconfigure Hadoop:

    $ ansible-playbook -i hosts -v site.yml -t hadoopconf

## Some files you may have on files/ directory

(Optional) By defalut, OpenJdk6 is installed. To install the recommended _JDK_ (Oracle/Sun 6u31), you will need to define `use_custom_jdk6` in `local.yml` and put some files in the files/ directory:

 - `jdk-6u31-linux-amd64.rpm`
 - `sun-javadb-client-10.6.2-1.1.i386.rpm`
 - `sun-javadb-common-10.6.2-1.1.i386.rpm`
 - `sun-javadb-core-10.6.2-1.1.i386.rpm`
 - `sun-javadb-demo-10.6.2-1.1.i386.rpm`
 - `sun-javadb-docs-10.6.2-1.1.i386.rpm`
 - `sun-javadb-javadoc-10.6.2-1.1.i386.rpm`

(Optional) If you use KickStart & infrastructure playbooks (to quickly deploy many virtual servers):

 - `kickstart_authorized_keys`

# License

Copyright (C) 2012 - Horacio Guillermo de Oro <hgdeoro@gmail.com>

License: Creative Commons - Attribution-ShareAlike 3.0 Unported

This means, you are free:

 - to Share - to copy, distribute and transmit the work
 - to Remix - to adapt the work
 - to make commercial use of the work

Under the following conditions:

 - *Attribution* - You must attribute the work in the manner specified by the author or licensor (but not in any way that suggests that they endorse you or your use of the work).
 - *Share Alike* - If you alter, transform, or build upon this work, you may distribute the resulting work only under the same or similar license to this one.

See: https://creativecommons.org/licenses/by-sa/3.0/

