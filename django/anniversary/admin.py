from django.contrib import admin

from .models import *


class ItemAdmin(admin.ModelAdmin):
    list_display = ("id", "name", "brand", "original_price", "discount_price",
            "original_points", "discount_points")

admin.site.register(Item, ItemAdmin)
