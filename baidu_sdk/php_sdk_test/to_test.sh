#!/bin/bash
for file in ./*_test.php
do
    php $file
done
