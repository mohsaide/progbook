from django.shortcuts import HttpResponse

def dashboard(request):
    return HttpResponse('Hello!')