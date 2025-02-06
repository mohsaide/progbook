import os
import sys
from django.core.wsgi import get_wsgi_application


sys.path.insert(0, "/progbook")

os.environ.setdefault("DJANGO_SETTINGS_MODULE", "progbook_project.settings")

application = get_wsgi_application()
