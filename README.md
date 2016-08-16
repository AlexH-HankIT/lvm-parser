# lvm-parser

# tests
output:
vgs --units b --separator "|" --unbuffered

get only snapshots:
lvs --units b --separator='|' --select "lv_attr=~[^s.*]" --unbuffered