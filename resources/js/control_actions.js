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
          return "<button type='button' class='btn btn-success btn-sm'>Vender </button> "+
           "<button type='button' class='btn btn-primary btn-sm'>Editar</button> "+
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

    $("body").on("click", ".evt-guardar-producto", function () {
        $(this).addClass("disabled");
        $(this).text("Guardando...");

        const urlGuardar = $(this).attr("data-url-guardar");
        const urlRedirect = $(this).attr("data-url-redirect");

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
              $(this).removeClass("disabled");
              $(this).text("Guardar");
            });
        
    });

    $("body").on("click", ".evt-actualizar-producto", function () {
      $(this).addClass("disabled");
      $(this).text("Actualizando...");

      const urlActualizar = $(this).attr("data-url-actualizar");
      const idproducto =  $(this).attr("data-id");
      const urlRedirect = $(this).attr("data-url-redirect");
      
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
            $(this).removeClass("disabled");
            $(this).text("Actualizar");
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
});