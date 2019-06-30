<link rel="Stylesheet" type="text/css" href="<?=base_url()?>assets/croppie/sweetalert.css" />
<link rel="Stylesheet" type="text/css" href="<?=base_url()?>assets/croppie/croppie.css" />
<link rel="Stylesheet" type="text/css" href="<?=base_url()?>assets/croppie/demo.css" />

<div class="content">
  <div class="panel">
    <div class="content-header no-mg-top">
      <i class="fa fa-newspaper-o"></i>
      <div class="content-header-title">Change Picture</div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <div class="content-box">

          <div class="demo-wrap upload-demo">
            <div class="container">
             
              
              <div class="upload-msg">
                Upload a file to start cropping
              </div>

              <div class="upload-demo-wrap">
                <div id="upload-demo"></div>
              </div>
              
              <div class="actions">
                <a class="btn file-btn">
                  <span>Upload</span>
                  <input type="file" id="upload" name="upload" value="Choose a file" accept="image/*" />
                </a>
                <button class="upload-result">Crop</button>
              </div>

              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>










<script src="<?=base_url()?>assets/croppie/sweetalert.min.js"></script>
<script src="<?=base_url()?>assets/croppie/croppie.js"></script>
<script src="<?=base_url()?>assets/croppie/demo.js"></script>

<script>
  Demo.init();
</script>



