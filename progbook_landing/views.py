from django.shortcuts import render


def landing_page(request):
    return render(request, 'landing_page/index.html' )

def login(request):
    return render(request, 'landing_page/login.html' )

def reset_password(request):
    return render(request, 'landing_page/reset_password.html' )

def service(request , name):
    context = {'name' : str(name).replace('_' , ' ').title() }
    return render(request, 'landing_page/service.html' , context )