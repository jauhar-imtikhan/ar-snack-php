<?php
function ListProduk(string $id, string $name, string $description, int $price, string $image, string $categories)
{
    $class = [
        "badge" => ["primary", "success", "danger", "info"],
    ];
    $element = '<div class="col-12 col-md-6 col-lg-4 my-3">
   <div class="card">
       <div class="card-body">
           <a href="' . base_url('detail/' . $id) . '" style=":hover{text-decoration:none; }">
               <img src="' . base_url('assets/img/' . $image . '') . '" alt="produk" class="img-fluid rounded">
           </a>
           <hr>
           <div class="row">
               <div class="col-6 col-md-6 col-lg-6">
                   <div class="d-flex ">
                       <h4 class="card-title" style=":hover{text-decoration: none;}">
                           ' . $name . '
                           <span class="badge badge-' . $class["badge"][rand(0, 3)] . '">' . $categories . ' </span>
                       </h4>
                   </div>
               </div>
               <div class="col-6 col-md-6 col-lg-6 ">
                   <span class="float-right">Rp. ' . $price . '</span>
               </div>
           </div>
           <p>' . $description . '</p>
           <div class="row">
               <div class="col-6 col-md-6 col-lg-6">
                   <a href="' . base_url('detail/' . $id) . '" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i> Detail Produk</a>
               </div>
               <div class="col-6 col-md-6 col-lg-6">
                   <button id="produk' . $id . '" type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-cart-plus"></i> Keranjang</button>

               </div>
           </div>

       </div>

   </div>
</div>';

    return $element;
}



function alert(string $type, string $message)
{

    return `<div class="alert alert-` . $type . ` alert-dismissible fade show" role="alert">
    ` . $message . `
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
     </div>`;
}


function product_carousel(
    string $link,
    string $name,
    string $image,
    int $price,
) {
    $element = '
                <div class="item wow">
                <a href="' . $link . '" style="text-decoration: none; color: black;">
                    <img style="max-width: 200px; border: 1px solid #ccc" class="img-product" src="' . base_url('uploads/foto-product/' . $image) . '" alt="' . $image . '">
                    <div class="name-product">' . $name . '</div>
                    <div class="price-product">' . Rp($price) . '</div>
                    </a>
                </div>
    ';
    return $element;
}
