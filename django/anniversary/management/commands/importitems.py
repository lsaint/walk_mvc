# coding: utf-8
import os

from django.core.management.base import BaseCommand, CommandError
from django.utils.timezone import now
from django.conf import settings
from anniversary.models import Item

pre_dir_name = "photo/"

class Command(BaseCommand):
    help = '导入items列表到数据库'

    def add_arguments(self, parser):
        parser.add_argument('items_list')
        parser.add_argument('photo_dir')


    def handle(self, *args, **options):
        items_list = options["items_list"]
        photo_dir = options["photo_dir"]
        if not self.verify_path(items_list, photo_dir):
            raise CommandError("file path errors")

        self.save_model(self.parse_items(items_list))
        self.cp_photo(photo_dir)


    def verify_path(self, items_list, photo_dir):
        if False in [os.path.isfile(items_list),
                        os.path.exists(photo_dir),
                        os.path.exists(settings.MEDIA_ROOT)]:
            return False
        self.stdout.write("verify_path path ok ...")
        return True


    def parse_items(self, items_list):
        def func_verify(lt):
            if len(lt) != 12:
                raise CommandError("line err: " + str(lt))
            return True

        ret = parse_setting(items_list, True, func_verify)
        self.stdout.write("parse txt done ...")
        return ret


    #id name brand photo major_type minor_type url original_price discount_price original_points discount_points active  
    def save_model(self, items):
        for item in items:
            model, created = Item.objects.get_or_create(id = int(item[0]))
            if not created and model.name == item[1]\
                       and model.brand == item[2]\
                       and model.photo == pre_dir_name + item[3]\
                       and model.major_type == int(item[4])\
                       and model.minor_type == int(item[5])\
                       and model.url == item[6]\
                       and model.original_price == float(item[7])\
                       and model.discount_price == float(item[8])\
                       and model.original_points == int(item[9])\
                       and model.original_points == int(item[10])\
                       and model.active == int(item[11]):
                continue
            else:
                model.name = item[1]
                model.brand = item[2]
                model.photo = pre_dir_name + item[3]
                model.major_type = int(item[4])
                model.minor_type = int(item[5])
                model.url = item[6]
                model.original_price = float(item[7])
                model.discount_price = float(item[8])
                model.original_points = int(item[9])
                model.discount_points = int(item[10])
                model.active = int(item[11])
                model.save()


    def cp_photo(self, photo_dir):
        os.system("cp -rf %s %s" % (photo_dir+"/", settings.MEDIA_ROOT+"/"+pre_dir_name[:-1]))
        self.stdout.write("copy photo done ...")


def parse_setting(setting_file, do_line_strip, func_verfiy):
    ret = []
    with open(setting_file, "r") as f:
        lines = f.readlines()
        lines = lines[1:]

        for line in lines:
            if do_line_strip:
                line = line.strip()
            #else:
                #line = line.decode("utf-8")
            if line == "":
                continue
            lt = line.split("\t")
            lt = list(map(lambda x: x.strip(), lt))
            if not func_verfiy(lt):
                return
            ret.append(lt)
    return ret
