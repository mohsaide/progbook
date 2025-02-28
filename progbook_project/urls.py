from django.contrib import admin
from django.urls import path , include

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', include('progbook_landing.urls') ),
    path('dashboard/', include('progbook_dashboard.urls') )
]