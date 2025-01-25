from django.shortcuts import render , HttpResponse

def landing_page(request):
    template_path = 'progbook_public/landing_page.html'
    context_value = request.GET.dict()
    return render(request, template_path, context_value)

