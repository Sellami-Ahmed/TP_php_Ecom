<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">New Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body mx-3">
                    <div class="form-group">
                        <label>Product Name:</label>
                        <input type="text" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="inlineFormCustomSelectPref">Category:</label>
                        <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price:</label>
                        <input type=number step=0.01 class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Quantity:</label>
                        <input type="number" class="form-control">
                    </div>
                    <div>
                        <div>
                            <label for="Image" class="form-label">Image:</label>
                            <input class="form-control" type="file" id="formFile" onchange="preview()">

                        </div>
                        <div class="container col-md-6">
                            <img style="margin-top: 20px;" id="frame" src="" class="img-fluid" />
                        </div>
                    </div>

                    <script>
                        function preview() {
                            frame.src = URL.createObjectURL(event.target.files[0]);
                        }

                        function clearImage() {
                            document.getElementById('formFile').value = null;
                            frame.src = "";
                        }
                    </script>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>