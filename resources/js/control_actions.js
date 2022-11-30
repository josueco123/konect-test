$(document).ready(function () {

  const table = $('#products').DataTable({
    searching: true,
    ajax: {
      "url": "products/getproducts",
      "dataSrc": ""
      },
      "columns":[          
        { data: "nombre_producto"},
        { data: "referencia_producto"},
        { data: "categoria_producto"},
        { data: "peso_producto"},
        { data: "stock_producto"},
        { "defaultContent": true, render: function ( data, type, row ) {
          return new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD', minimumFractionDigits: 0}).format(row.precio_producto);
          }
        },
        { "defaultContent": true,render: function ( data, type, row ) {
          return "<button type='button' class='btn btn-success btn-sm evt-vender'>Vender </button> "+
           "<button type='button' class='btn btn-primary btn-sm evt-editar'>Editar</button> "+
          "<button type='button' class='btn btn-danger btn-sm evt-eliminar'>Eliminar</button></td>"
         
        }
      }
    ]
  });

  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  $("body").on("click", ".evt-agregar", function () {  
    
    const urlResponse = window.location.href + "/add_products"         
    $(location).attr("href", urlResponse);

  });

    $("body").on("click", ".evt-guardar-producto", function () {
        const $boton = $(this)
        $boton.addClass("disabled");
        $boton.text("Guardando...");

        const urlGuardar = $boton.attr("data-url-guardar");
        const urlRedirect = $boton.attr("data-url-redirect");

          $.ajax({
            url: urlGuardar,
            dataType: "json",
            data: $('#form-producto').serialize(),
            type: "post",
          })
            .done(function (resp) {
              if (resp.status_code == 200) {
                swalWithBootstrapButtons.fire(
                    '!Éxito!',
                    resp.mensaje,
                  'success'
                )
                setTimeout(() => {
                  $(location).attr("href", urlRedirect);
                }, 1500);           
              } else {
                swalWithBootstrapButtons.fire(
                  'Error',
                  resp.mensaje,
                  'error'
                );                
              }
             
            })
            .fail(function () {
              swalWithBootstrapButtons.fire(
                'Error',
                'Ups, sucedió un error, por favor intenta más tarde o contacta al administrador',
                'error'
              );
              $boton.removeClass("disabled");
              $boton.text("Guardar");
            });
        
    });

    $("body").on("click", ".evt-editar", function () {  

      const data = table.row( $(this).parents('tr') ).data();      
      const urlResponse = window.location.href + "/edit_product/" + data["id_producto"];            
      $(location).attr("href", urlResponse);
  
    });

    $("body").on("click", ".evt-actualizar-producto", function () {
      const $boton = $(this)
      $boton .addClass("disabled");
      $boton .text("Actualizando...");

      const urlActualizar = $boton.attr("data-url-actualizar");
      const idproducto =  $boton.attr("data-id");
      const urlRedirect = $boton.attr("data-url-redirect");
      
        $.ajax({
          url: urlActualizar + '/' + idproducto,
          dataType: "json",
          data: $('#form-producto').serialize(),
          type: "post",
        })
          .done(function (resp) {            
            if (resp.status_code == 200) {
              swalWithBootstrapButtons.fire(
                  '!Éxito!',
                  resp.mensaje,
                'success'
              )
              setTimeout(() => {
                $(location).attr("href", urlRedirect);
              }, 1500);           
            } else {
              swalWithBootstrapButtons.fire(
                'Error',
                resp.mensaje,
                'error'
              );              
            }
            
          })
          .fail(function () {
            swalWithBootstrapButtons.fire(
              'Error',
              'Ups, sucedió un error, por favor intenta más tarde o contacta al administrador',
              'error'
            );
            $boton.removeClass("disabled");
            $boton.text("Actualizar");
          });
      
    });

    $("body").on("click", ".evt-eliminar", function () {  
      
      const data = table.row( $(this).parents('tr') ).data();

      const urlDelete = window.location.href + "/delete_product/" + data["id_producto"];
      
      swalWithBootstrapButtons.fire({
        title: "Eliminar Producto",
        text: "¿Esta seguro que deseas eliminar est Producto?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: "Cancelar"
      }).then(function (result) {
        if (result.value) {
         
          $.ajax({
            url: urlDelete,
            dataType: "json",
            type: "post",
            contentType: false,
            processData: false,
            cache: false,
            async: false,
          })
            .done(function (resp) {
              if (resp.status_code == 200) {
               table.ajax.url(window.location.href +'/getproducts').load();
               swalWithBootstrapButtons.fire(
                 '!Éxito!',
                 resp.mensaje,
                 'success'
               );                
                
              } else {
                swalWithBootstrapButtons.fire(
                  'Error',
                  resp.mensaje,
                  'error'
                );
              }
            })
            .fail(function () {
              swalWithBootstrapButtons.fire(
                'Error',
                'Ups, sucedió un error, por favor intenta más tarde o contacta al administrador',
                'error'
              );
            });
        }
      });
    });

    $("body").on('click', '.evt-vender', function () {

      const data = table.row( $(this).parents('tr') ).data();

      const precio = new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD', minimumFractionDigits: 0}).format(data['precio_producto']);
      $('.name_product').text('Producto: '+ data['nombre_producto']);
      $('.referencia_producto').text('Referencia: '+ data['referencia_producto']);
      $('.stock').text('Stock: '+ data['stock_producto']);
      $('.precio_producto').text('Precio: '+ precio); 
      $('input[name="id_producto"]').val(data['id_producto']);          
      $('#venderModal').modal('show');
    });

    $("body").on("click", ".evt-guardar-venta", function () {

      const $boton = $(this)
      $boton.addClass("disabled");
      $boton.text("Guardando...");
      $('#venderModal').modal('hide');

      const urlGuardar = $(this).attr("data-url-guardar");
     
        $.ajax({
          url: urlGuardar,
          dataType: "json",
          data: $('#form-venta').serialize(),
          type: "post",
        })
          .done(function (resp) {
            $boton.removeClass("disabled");
            $boton.text("Guardar");
            if (resp.status_code == 200) {
              swalWithBootstrapButtons.fire(
                  '!Éxito!',
                  resp.mensaje,
                'success'
              )
              table.ajax.url(window.location.href +'/getproducts').load();          
            } else {
              swalWithBootstrapButtons.fire(
                'Error',
                resp.mensaje,
                'error'
              );                
            }
            
          })
          .fail(function () {
            swalWithBootstrapButtons.fire(
              'Error',
              'Ups, sucedió un error, por favor intenta más tarde o contacta al administrador',
              'error'
            );
            $boton.removeClass("disabled");
            $boton.text("Guardar");
          });
      
      });

      $("body").on("click", ".item-1", function () {
        $(this).addClass("active");
        $('.item-2').removeClass("active");
      }); 

      $("body").on("click", ".item-2", function () {
        $(this).addClass("active");
        $('.item-1').removeClass("active");
      }); 
});