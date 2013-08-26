Ansible playbook for my Hadoop cluster
--------------------------------------

Install Hadoop in CentOS 6.4 server.

## Already done

- works against CentOS 6.4
- set YUM mirror and proxy
- disable YUM 

### TODO

- initial setup of ssh keys and sudo
- parametrization of ssh user to connect
- parametrization of proxy and YUM mirror

# Some notes

To disable ssh host key checking:

    $ export ANSIBLE_HOST_KEY_CHECKING=False

To run a check:

    $ ansible-playbook -i hosts --check -v site.yml

To run the playbook:

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

