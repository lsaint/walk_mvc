
from django.shortcuts import render, get_object_or_404, redirect
from django.http import HttpResponse, HttpResponseRedirect, JsonResponse, Http404


from .models import Item


#def index(request):
#    return render(request, 'anniversary/index.html')


def pullitems(request, major_type):
    items = Item.objects.filter(major_type=major_type, active=True)
    jn = {}
    for i in items:
        jn.setdefault(i.minor_type, []).append((i.id, i.name,
                i.brand, i.photo.url, i.original_price, i.discount_price,
                i.original_points, i.discount_points))

    return JsonResponse(jn, safe=False)


def click(request, item_id):
    item = get_object_or_404(Item, pk = item_id)
    if item.active:
        item.hits += 1
        item.save()
        url = item.url
        exception = list(range(95, 104+1)) + list(range(123, 132+1))
        if request.GET.get("m") == "true" and \
                int(item_id) not in exception:
            url = url.replace("www", "m")
        return redirect(url)
    raise Http404("商品不存在或已下架")

