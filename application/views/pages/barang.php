<main id="main" class="main" style="/*margin-left: 250px;padding: 10px 20px;*/">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Master Barang</h5>
              
              <div class="row">
                <table  style="width:60%">
                  <tr>
                    <td>
                      <button class="btn btn-sm btn-primary rounded-pill" style="margin-bottom: 10px;" id="add_data"><i class="bi bi-cloud-plus-fill"></i> Tambah</button>
                    </td>
                    <td>
                      Kategori
                    </td>
                    <td>
                      <select class="form-select" name="src_kategori" onchange="REFRESH_DATA()">
                        <option value="">All</option>
                        <?php
                          foreach($kategori as $kat){
                            echo "<option value='".$kat->id_kategori."'>".$kat->deskripsi."</option>";
                          }
                        ?>
                      </select>
                    </td>
                    <td>
                      Lab
                    </td>
                    <td>
                      <select class="form-select" name="src_laborat" onchange="REFRESH_DATA()">
                        <option value="">All</option>
                        <?php
                          foreach($laborat as $lab){
                            echo "<option value='".$lab->id_laborat."'>".$lab->deskripsi."</option>";
                          }
                        ?>
                      </select>
                    </td>
                  </tr>
                </table>
              </div>
           
              <table id="tb_data" class="table table-bordered table-striped" style="font-size:12px;">
                <thead>
                  <tr style="text-align: center;">
                    <th></th>
                    <th >Kode</th>
                    <th >Deskripsi</th>
                    <th >Kat</th>
                    <th >Lab</th>
                    <th >Total Stok</th>
                    <th >Stok tersedia</br>di Lab</th>
                    <th >Min Stock</th>
                    <!-- <th >Harga Barang</th>
                    <th >Min Stock</th>
                    <th >Photo</th> -->
                    <th >Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>

        </div>

      </div>

      <!-- Basic Modal -->
      <div class="modal fade" id="modal_add" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form id="FRM_DATA" method="post" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title">Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Kategori</label>
                      <select name="id_kategori" id="" class="form-select" onchange="generate_kode()">
                        <option value="" disabled selected> - Pilih - </option>
                        <?php
                          foreach($kategori as $kat){
                            echo "<option value='".$kat->id_kategori."'>".$kat->deskripsi."</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Laboratorium</label>
                      <select name="id_laborat" id="" class="form-select" onchange="generate_kode()">
                        <option value="" disabled selected> - Pilih - </option>
                        <?php
                          foreach($laborat as $lab){
                            echo "<option value='".$lab->id_laborat."'>".$lab->deskripsi."</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Kode Barang</label>
                      <input type="text" class="form-control" name="id_barang" readonly>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Deskrispsi</label>
                      <textarea name="nama_barang"  class="form-control" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Stok</label>
                      <input type="text" class="form-control" name="stock" onkeypress="return onlyNumberKey(event)" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Stok Tersedia</label>
                      <input type="text" class="form-control" name="stock_tersedia" onkeypress="return onlyNumberKey(event)" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Min Stok</label>
                      <input type="text" class="form-control" name="min_stock" placeholder="Minimum Stok" onkeypress="return onlyNumberKey(event)">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Harga Beli</label>
                      <input type="test" class="form-control" name="harga_beli" onkeypress="return onlyNumberKey(event)" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label id="lbl_foto">Foto</label>
                      <div class="custom-file">
                        <input type="file"  name="foto" accept="image/png, image/gif, image/jpeg">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="BTN_SAVE">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div><!-- End Basic Modal-->
    </section>

  </main>
  <script src="<?php echo base_url('/assets/jquery/jquery.min.js'); ?>"></script>
  <script>
    var save_method;
    var id_data;
    var tb_data;

    $(function(){
      REFRESH_DATA()

      $("[name='src_jenis']").change(function(){
        REFRESH_DATA()
      })

      $("#add_data").click(function(){
        $("#FRM_DATA")[0].reset()
        $("[name='no_induk']").attr('readonly', false)
        save_method = "save"
        $("#modal_add .modal-title").text('Add Data')
        $("#modal_add").modal('show')
      })

      $("#FRM_DATA").on('submit', function(event){
        event.preventDefault();
        let formData = new FormData(this);

        
        if(save_method == 'save') {
            urlPost = "<?php echo site_url('barang/saveData') ?>";
        }else{
            urlPost = "<?php echo site_url('barang/updateData/') ?>"+id_data;
        }
        // console.log(formData)
        ACTION(urlPost, formData)
        $("#modal_add").modal('hide')
      })

    })

    function REFRESH_DATA(){
      $('#tb_data').DataTable().destroy();
      tb_data =  $("#tb_data").DataTable({
          "order": [[ 1, "desc" ]],
          "pageLength": 25,
          "autoWidth": false,
          "responsive": true,
          "ajax": {
              "url": "<?php echo site_url('barang/getAllDataByUser') ?>",
              "type": "POST",
              "data": {
                "id_kategori" : $("[name='src_kategori']").val(),
                "id_laborat" : $("[name='src_laborat']").val()
              }
          },
          "createdRow": function( row, data, dataIndex){
            console.log($(row))
                if( parseInt(data.stock) <= parseInt(data.min_stock)){

                    $(row).css({"background-color":"yellow"});

                }
            },
          "columns": [
              {
                "className":      'dt-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
              },
              { "data": "id_barang" },
              { "data": "nama_barang"},
              { "data": "id_kategori"},
              { "data": "id_laborat"},
              { "data": "stock"},
              { "data": "stock_tersedia"},
              // { "data": "harga_beli"},
              { "data": "min_stock"},
              // { "data": "foto"},
              { "data": null, 
                "render" : function(data){
                  return "<button class='btn btn-sm btn-warning' title='Edit Data' onclick='editData("+JSON.stringify(data)+");'><i class='bi bi-pencil-square'></i> </button> "+
                    "<button class='btn btn-sm btn-danger' title='Hapus Data' onclick='deleteData(\""+data.id_barang+"\");'><i class='bi bi-trash'></i> </button>"
                },
                className: "text-center"
              },
          ]
        }
      )
    }

    function format ( d ) {
      // `d` is the original data object for the row
      if(d.foto){
        img = "<a target='_blank' href='<?php echo base_url() ?>assets/images/barang/"+d.foto+"'><img  style='max-width: 120px;' class='img-fluid' src='<?php echo base_url() ?>assets/images/barang/"+d.foto+"' ></a>";
      }else{
        img = "No Image"
      }
      return '<table class="table table-bordered" style="width:450px;">'+
          '<tr>'+
              '<td style="width:80px;">Photo:</td>'+
              '<td>'+img+'</td>'+
          '</tr>'+
          '<tr>'+
              '<td>Harga:</td>'+
              '<td>'+d.harga_beli+'</td>'+
          '</tr>'+
          '<tr>'+
              '<td>Min Stock:</td>'+
              '<td>'+d.min_stock+'</td>'+
          '</tr>'+
      '</table>';
    }

    $('#tb_data tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = tb_data.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

    function editData(data, index){
      console.log(data)
      save_method = "edit"
      id_data = data.id_barang;
      $("[name='foto']").val('')
      $("#lbl_foto").text("Ganti Foto")
      $("#modal_add .modal-title").text('Edit Data')
      $("[name='id_barang']").val(data.id_barang)
      $("[name='nama_barang']").val(data.nama_barang)
      $("[name='stock']").val(data.stock)
      $("[name='stock_tersedia']").val(data.stock_tersedia)
      $("[name='harga_beli']").val(data.harga_beli.replaceAll(".",""))
      $("[name='min_stock']").val(data.min_stock)
      $("[name='id_kategori']").val(data.id_kategori)
      $("[name='id_laborat']").val(data.id_laborat)

      $("#modal_add").modal('show')
    }

    function ACTION(urlPost, formData){
      $.ajax({
        url: urlPost,
        type: "POST",
        data: formData,
        beforeSend: function(){
          $("#LOADER").show();
        },
        complete: function(){
          $("#LOADER").hide();
        },
        processData : false,
        cache: false,
        contentType : false,
        success: function(data){
          data = JSON.parse(data)
          console.log(data)
          if (data.status == "success") {
            toastr.info(data.message)
            REFRESH_DATA()

          }else{
            toastr.error(data.message)
          }
        },
        error: function (err) {
          console.log(err);
        }
      })
    }

    function deleteData(id){
      if(!confirm('Delete this data?')) return

      urlPost = "<?php echo site_url('barang/deleteData') ?>";
      formData = "id_barang="+id
      
      $.ajax({
          url: urlPost,
          type: "POST",
          data: formData,
          dataType: "JSON",
          success: function(data){
            // console.log(data)
            if (data.status == "success") {
              toastr.info(data.message)
              

              REFRESH_DATA()

            }else{
              toastr.error(data.message)
            }
          }
      })
    }

    function generate_kode(){
      if($("[name='id_kategori']").val() && $("[name='id_laborat']").val()){
        $.ajax({
          url: "<?php echo site_url('barang/generate_kode') ?>",
          type: "POST",
          data: {
            id_kategori : $("[name='id_kategori']").val(),
            id_laborat : $("[name='id_laborat']").val()
          },
          success: function(data){
            $("[name='id_barang']").val(data)
          }
        })
      }
      
    }
  </script>