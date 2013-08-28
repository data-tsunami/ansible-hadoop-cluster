Ansible playbook for my Hadoop cluster
--------------------------------------

Setup a Hadoop cluster on CentOS 6.4 servers.

This playbook:

- configures CentOS to use a http proxy (like Squid) to speedup installs of RPMs
- mounts a NFS share (it's up to you to setup the NFS server) to centralize Hadoops logs
- install Java and Hadoop.

You must have:

 - a NFS server: it's up to you to setup the NFS server, and export a share as read-write
 - Sun/Oracle JDK 1.6u31 64bits + Hadoop binaries in the files/ directory (see files/README.txt)

The customizations are loaded from local.yml (see local.yml.example).

## Already done

- works against CentOS 6.4
- set YUM mirror and proxy
- disable fastestmirror YUM plugin
- setup NFS client & fstab (to share logs)
- install JDK
- install Hadoop
- setup Hadoop

### TODO

- FIX: format the NameNode
- FIX: easier install of Hadoop: download binary from mirror if not exists in files/
- FIX: make NFS optional
- Setup NFS server (on master or 'infrastructure' server; required for centralized logs)
- Setup web server (required for kickstar)
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

To ping the hosts:

    $ ansible-playbook -i hosts -t check site.yml

Setup the cluster:

    $ ansible-playbook -i hosts site.yml

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

