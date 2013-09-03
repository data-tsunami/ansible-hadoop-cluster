Ansible playbook for my Hadoop cluster
--------------------------------------

Setup a Hadoop cluster on CentOS 6.4 servers.

This playbook starts with a just installed CentOS 6.4 (you need ssh access + sudo working) and:

- configures each nodes to use a http proxy to speedup installs of RPMs (to be kind with mirrors and do faster deploys)
- setups /etc/fstab and mounts a NFS share in each node (it's up to you to setup the NFS server) to centralize Hadoops logs
- install Java and Hadoop on each node
- format the name node.

To make this work, you must have:

 - a NFS server configured: it's up to you to setup the NFS server, and export a share as read-write
 - Sun/Oracle JDK 1.6u31 64bits + Hadoop binaries in the ./files/ directory (see ./files/README.txt)
 - your hosts defined in `hosts` file (see `hosts.example` as reference)
 - your settings customized in `local.yml` file (see `local.yml.example` as reference)

## Already done

- works against CentOS 6.4
- set YUM mirror and proxy
- disable fastestmirror YUM plugin
- setup NFS client & fstab (to share logs)
- install JDK
- install Hadoop
- setup Hadoop
- start/stop Hadoop cluster

### TODO

- FIX: easier install of Hadoop: download binary from mirror if not exists in files/
- FIX: make NFS optional
- Setup NFS server (on master or 'infrastructure' server; required for centralized logs)
- Setup web server (required for kickstart)
- Setup init scripts for Hadoop
- Deploy KickStart file on web server
- Initial setup of ssh keys and sudo? (don't know if possible, since it's required for Ansible)

### Some ideas

- add monitoring (ej: nagios, munin, ganglia, etc.)
- create virtual machines with libvirt
- setup DNS? (on 'infrastructure' server)
- setup seconrady DNS on all the nodes?

# Some notes

To disable ssh host key checking:

    $ export ANSIBLE_HOST_KEY_CHECKING=False

Setup the cluster:

    $ ansible-playbook -i hosts site.yml

To start Hadoop:

    $ ansible-playbook -i hosts -v start-hadoop.yml

To stop Hadoop:

    $ ansible-playbook -i hosts -v stop-hadoop.yml

To run a command on all the nodes:

    $ ansible -i hosts nodes -m command -a "sudo du -hsx /srv/hadoop"

# License

Creative Commons - Attribution-ShareAlike 3.0 Unported

This means, you are free:

 - to Share - to copy, distribute and transmit the work
 - to Remix - to adapt the work
 - to make commercial use of the work

Under the following conditions:

 - *Attribution* - You must attribute the work in the manner specified by the author or licensor (but not in any way that suggests that they endorse you or your use of the work).
 - *Share Alike* - If you alter, transform, or build upon this work, you may distribute the resulting work only under the same or similar license to this one.

See: https://creativecommons.org/licenses/by-sa/3.0/

