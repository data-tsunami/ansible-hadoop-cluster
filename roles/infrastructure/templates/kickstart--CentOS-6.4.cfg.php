<?php

header('Content-type: text/plain');

$ip       = $_GET["ip"]       or die("Missing 'ip' parameter - for example: 'ip=192.168.122.141&hostname=hadoop1'");
$hostname = $_GET["hostname"] or die("Missing 'hostname' parameter - for example: 'ip=192.168.122.141&hostname=hadoop1'");
$hadoop_part = $_GET["hadoop_part"];

?>
#platform=x86, AMD64, or Intel EM64T
#version=DEVEL

firewall --disabled
install
cdrom
rootpw r
auth  --useshadow  --passalgo=sha512
user --name {{ks_username}} --password {{ks_password}}
text
keyboard {{ks_keyboard}}
url --url {{yum_mirror}}/os/x86_64/
lang en_US
selinux --permissive
skipx
logging --level=info
reboot
timezone --isUtc {{ks_timezone}}

network --noipv6 --bootproto=static --ip=<?php echo $ip ?> --hostname=<?php echo $hostname ?>.{{ks_network_domain}} --netmask={{ks_network_mask}} --gateway={{ks_network_gw}} --nameserver={{ks_network_dns}} --device=eth0

bootloader --location=mbr
zerombr
clearpart --all --initlabel 
part /boot --asprimary --fstype="ext4" --size=200
part swap --fstype="swap" --size=512
part / --fstype="ext4" --grow --size=1
<?php if($hadoop_part) { ?>
part /srv/hadoop --fstype="ext4" --size=<?php echo $hadoop_part ?>
<?php } ?>

#-----------------------------------------------------------------------------
# Packages
#-----------------------------------------------------------------------------

%packages --nobase --excludedocs
coreutils
wget
%end

#-----------------------------------------------------------------------------
# Scripts
#-----------------------------------------------------------------------------

%post --log=/root/kickstart.log

#-----------------------------------------------------------------------------
# ssh keys
#-----------------------------------------------------------------------------

mkdir      /home/{{ks_username}}/.ssh /root/.ssh
chmod 0700 /home/{{ks_username}}/.ssh /root/.ssh

wget -O /home/{{ks_username}}/.ssh/authorized_keys http://{{ks_server_ip}}/kickstart_authorized_keys
wget -O /root/.ssh/authorized_keys                 http://{{ks_server_ip}}/kickstart_authorized_keys

chown -R {{ks_username}}.{{ks_username}} /home/{{ks_username}}/.ssh
chown -R root.root                       /root/.ssh

chmod 0600 /home/{{ks_username}}/.ssh/authorized_keys /root/.ssh/authorized_keys

#-----------------------------------------------------------------------------
# sudo
#-----------------------------------------------------------------------------

echo '%wheel ALL=(ALL) NOPASSWD: ALL' > /etc/sudoers.d/wheel
usermod -a -G wheel {{ks_username}}

%end
