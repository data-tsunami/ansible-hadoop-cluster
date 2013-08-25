Ansible playbook for my Hadoop cluster
--------------------------------------

To disable ssh host key checking:

    $ export ANSIBLE_HOST_KEY_CHECKING=False

To run a check:

    $ ansible-playbook -i hosts --check -v site.yml

To run the playbook:

    $ ansible-playbook -i hosts site.yml

