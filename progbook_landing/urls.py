from django.urls import path
from . import views
urlpatterns = \
[
    path('' , views.landing_page , name = 'home'),
    path( 'service/<str:name>/' , views.service , name = 'service')
]