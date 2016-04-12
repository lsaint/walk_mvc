# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import migrations, models
import django.utils.timezone


class Migration(migrations.Migration):

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Item',
            fields=[
                ('id', models.AutoField(serialize=False, verbose_name='ID', primary_key=True, auto_created=True)),
                ('name', models.CharField(max_length=48)),
                ('brand', models.CharField(max_length=48)),
                ('photo', models.ImageField(upload_to='')),
                ('major_type', models.PositiveIntegerField(db_index=True)),
                ('minor_type', models.PositiveIntegerField()),
                ('url', models.URLField()),
                ('original_price', models.PositiveIntegerField()),
                ('discount_price', models.PositiveIntegerField()),
                ('hits', models.PositiveIntegerField()),
                ('active', models.BooleanField(default=True)),
                ('ctime', models.DateTimeField(default=django.utils.timezone.now)),
            ],
        ),
    ]
