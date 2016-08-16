# lvm-parser
[![Build Status](https://api.travis-ci.org/MrCrankHank/lvm-parser.svg)](https://api.travis-ci.org/MrCrankHank/lvm-parser.svg)
[![Total Downloads](https://poser.pugx.org/mrcrankhank/lvm-parser/downloads)](https://packagist.org/packages/mrcrankhank/lvm-parser)
[![Latest Stable Version](https://poser.pugx.org/mrcrankhank/lvm-parser/v/stable)](https://packagist.org/packages/mrcrankhank/lvm-parser)
[![Latest Unstable Version](https://poser.pugx.org/mrcrankhank/lvm-parser/v/unstable)](https://packagist.org/packages/mrcrankhank/lvm-parser)
[![License](https://poser.pugx.org/mrcrankhank/lvm-parser/license)](https://packagist.org/packages/mrcrankhank/lvm-parser)

### Description
A parser for the output of the pvs/vgs/lvs commands

### Api documentation
https://mrcrankhank.github.io/lvm-parser/

### Packagist
https://packagist.org/packages/mrcrankhank/lvm-parser

### Testing
The project contains multiple tests, which can be executed via phpunit.

### Some random notes for the author:
* vgs --units b --separator "|" --unbuffered
* lvs --units b --separator='|' --select "lv_attr=~[^s.*]" --unbuffered