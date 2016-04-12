# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('anniversary', '0002_auto_20151111_1707'),
    ]

    operations = [
        migrations.AlterField(
            model_name='item',
            name='discount_price',
            field=models.FloatField(default=0),
        ),
        migrations.AlterField(
            model_name='item',
            name='original_price',
            field=models.FloatField(default=0),
        ),
    ]
