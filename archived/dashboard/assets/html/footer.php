
</div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer" style='background-color:#19756D !important;' >
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <strong style='color:white !important;'>Copyright &copy; CLS 2023</strong>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../../assets/html/login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

        <!-- support Modal-->
        <div class="modal fade" id="support_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">What is the issue?</h5>
                    </button>
                </div>
                <div class="modal-body">

                <form id="support_form">
                    <div class="form-group">
                        <label for="comments">Message :</label>
                        <textarea class="form-control" id="support_message" name="message" rows="5" placeholder="Enter your well described message here"></textarea>
                        <input type="hidden" name="to" value="mohammad2001saide@gmail.com">
                        <input type="hidden" name="secret_code" value="SECRET_TOKEN">
                        <input type="hidden" id='support_subject' name="subject" value="">
                    </div>
                    </form>
                           <div class="alert alert-success" style='display:none' role="alert" id='support_success_message'>
                            <strong>Success!</strong> Your message has been sent, please wait our respond.
                            </div>

                            <div class="alert alert-danger" style='display:none' role="alert" id='support_fail_message'>
                            <strong>Sorry!  </strong> Your message is empty. 
                            </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"  onclick="Myclear(event)" >Cancel</button>
                    <a class="btn btn-primary" onclick="send(event)">Send</a>
                </div>
            </div>
        </div>
    </div>

    <!-- manual_reset Modal-->
    <div class="modal fade" id="manual_reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Let's change your account's password.</h5>
                    </button>
                </div>
                <div class="modal-body">


                <form class="form" role="form" autocomplete="off" id='reset_form'>
                                
                                <div class="form-group">
                                    <label for="inputPasswordNew">New Password</label>
                                    <input type="password" class="form-control" name='NewPassword' id="inputPasswordNew" required>
                                    <span class="form-text small text-muted">
                                            Make sure to insert strong password.
                                        </span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNewVerify">Verify</label>
                                    <input type="password" class="form-control" name='Verify' id="inputPasswordNewVerify" required>
                                    <span class="form-text small text-muted">
                                            To confirm, type the new password again.
                                        </span>
                                </div>

                            <div class="alert alert-success" style='display:none' role="alert" id='success_message'>
                            <strong>Success!</strong> Your password has been updated.
                            </div>

                            <div class="alert alert-danger" style='display:none' role="alert" id='fail_message'>
                            <strong>Sorry!  </strong> <p id='reason' style='display:inline'></p> 
                            </div>
                </form>

                <div class="modal-footer">
                    <a class="btn btn-secondary" type="button" data-dismiss="modal"  onclick="Myclear(event)">Cancel</a>
                    <a class="btn btn-primary" onclick="reset(event)">Change</a>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/main.js"></script>
    <script src="../js/custom_dash.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>

