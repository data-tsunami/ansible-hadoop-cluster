Ansible playbook for my Hadoop cluster
--------------------------------------

Setup a Hadoop cluster on CentOS 6.4 servers.

There are a lot of hardcoded stuff, but I share this
as an exampe of what Andible can do (and how to do it).

Requires a working http proxy (like Squid) to speedup installs,
and a exported NFS, to centralize Hadoops logs, and some binaries
downloables from an HTTP server (JDK, Hadoop).

## Already done

- works against CentOS 6.4
- set YUM mirror and proxy
- disable fastestmirror YUM plugin
- setup NFS client & fstab (to share logs)
- install JDK
- install Hadoop
- setup Hadoop

### TODO

- remove all the hardcoded values (proxy, mirror, etc.)
- parametrization of namenode, secnamenode, tasktracker
- initial setup of ssh keys and sudo
- add example 'hosts' for Ansible

### Some ideas

- setup NFS server? (ej: on master or dedicated server)
- setup DNS? (ej: on master or dedicated server)
- setup HTTP server (ej: on master or dedicated server)
- setup seconrady DNS on all the nodes?
- other Hadoop versions?
- add KickStart file on HTTP server
- add monitoring (ej: nagios, munin, ganglia, etc.)

# Some notes

To disable ssh host key checking:

    $ export ANSIBLE_HOST_KEY_CHECKING=False

To ping the hosts:

    $ ansible-playbook -i hosts -t ping site.yml

Setup master:

    $ ansible-playbook -i hosts -l master -v site.yml

Setup slaves:

    $ ansible-playbook -i hosts -l slave -v site.yml

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

