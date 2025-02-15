from django.shortcuts import render


def landing_page(request):
    from django.conf import settings
    parameters = {'statics_path' : settings.STATIC_ROOT }
    return render(request, 'landing_page_index.html' , parameters )