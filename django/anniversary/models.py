from django.db import models
from django.utils.timezone import now

# Create your models here.

class Item(models.Model):
    name = models.CharField(max_length=48)         # 产品名
    brand = models.CharField(max_length=48)        # 品牌名
    photo = models.ImageField(upload_to='photo')
    major_type = models.PositiveIntegerField(db_index=True, default=0)     # 大类
    minor_type = models.PositiveIntegerField(default=0)                  # 小类
    url = models.URLField()
    original_price = models.FloatField(default=0)  # 市场价
    discount_price = models.FloatField(default=0)  # 活动价
    original_points = models.PositiveIntegerField(default=0)  # 原积分价
    discount_points = models.PositiveIntegerField(default=0)  # 折扣积分价
    hits = models.PositiveIntegerField(default=0)            # 点击量
    active = models.BooleanField(default=True)
    ctime = models.DateTimeField(default=now)
