
from django.conf.urls import include, url
from django.views.generic import TemplateView
import anniversary.views as views

urlpatterns = [
    url(r'^$', TemplateView.as_view(template_name='anniversary/index.html'), name='index'),
    url(r'^rules$', TemplateView.as_view(template_name='anniversary/rules.html'), name='rules'),
    url(r'^pc$', TemplateView.as_view(template_name='anniversary/pc-index.html'), name='pc'),
    url(r'^m$', TemplateView.as_view(template_name='anniversary/m-index.html'), name='m'),
    url(r'^pc_rules$', TemplateView.as_view(template_name='anniversary/pc-rules.html'), name="pcrules"),
    url(r'^detail$', TemplateView.as_view(template_name='anniversary/detail.html'), name="detail"),
    url(r'^item/(?P<item_id>[0-9]+)$', views.click, name='click'),
    url(r'^pullitems/(?P<major_type>[0-9]+)$', views.pullitems, name='pullitems'),
]
