from django.shortcuts import render


def landing_page(request):
    return render(request, 'landing_page/index.html' )

def service(request , name):
    context = {'name' : str(name).replace('_' , ' ').title() }
    return render(request, 'landing_page/service.html' , context )