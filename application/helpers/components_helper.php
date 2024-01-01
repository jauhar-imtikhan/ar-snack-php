<?php
function ListProduk(
    string $id,
    string $name,
    string $description,
    int $price,
    string $image,
    string $categories,
    int $weight
) {
    $class = [
        "badge" => ["primary", "success", "danger", "info"],
    ];
    $element = '<div class="col-12 col-md-6 col-lg-4 my-3 ">
   <div class="card ">
       <div class="card-body">
           <a href="' . base_url('produk/detail/' . $id) . '" style=":hover{text-decoration:none; }" class="d-flex justify-content-center">
               <img style="width: 500px;" src="' . base_url('uploads/foto-product/' . $image . '') . '" alt="produk" class="img-fluid rounded">
           </a>
           <hr>
           <div class="row d-flex flex-wrap">
               <div class="col-12 col-md-6 col-lg-6">
                   <div class="d-flex ">
                       <h4 class="card-title" style=":hover{text-decoration: none;}">
                           ' . $name . '
                           <span class="badge badge-' . $class["badge"][rand(0, 3)] . '">' . $categories . ' </span>
                       </h4>
                   </div>
               </div>
               <div class="col-12 col-md-6 col-lg-6 mb-4">
                   <span class="d-none d-md-block d-lg-block float-right">Rp. ' . $price . '</span>
                   <span class="d-lg-none">Rp. ' . $price . '</span>
               </div>
           </div> 
           <p>' . $description . '</p>
           <div class="row d-flex flex-wrap">
               <div class="col-12 col-md-6 col-lg-6 mb-3">
                   <a href="' . base_url('produk/detail/' . $id) . '" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i> Detail Produk</a>
               </div>
               <div class="col-6 col-md-6 col-lg-6">
                   <button id="produk' . $id . '" onclick= " addToCart(`' . $id . '`, `' . $price . '`, `' . $image . '`, `' . $weight . '`, `' . $name . '`)" type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-cart-plus"></i> Keranjang</button>

               </div>
           </div>

       </div>

   </div>
</div>';

    return $element;
}

function ListProdukSingle(
    string $id,
    string $name,
    string $description,
    int $price,
    string $image,
    string $categories,
    int $weight
) {
    $class = [
        "badge" => ["primary", "success", "danger", "info"],
    ];
    $element = '<div class="col-12 col-md-6 col-lg-12 my-3 ">
   <div class="card ">
       <div class="card-body">
           <a href="' . base_url('produk/detail/' . $id) . '" style=":hover{text-decoration:none; }" class="d-flex justify-content-center">
               <img style="width: 500px;" src="' . base_url('uploads/foto-product/' . $image . '') . '" alt="produk" class="img-fluid rounded">
           </a>
           <hr>
           <div class="row d-flex flex-wrap">
               <div class="col-12 col-md-6 col-lg-6">
                   <div class="d-flex ">
                       <h4 class="card-title" style=":hover{text-decoration: none;}">
                           ' . $name . '
                           <span class="badge badge-' . $class["badge"][rand(0, 3)] . '">' . $categories . ' </span>
                       </h4>
                   </div>
               </div>
               <div class="col-12 col-md-6 col-lg-6 mb-4">
                   <span class="d-none d-md-block d-lg-block float-right">Rp. ' . $price . '</span>
                   <span class="d-lg-none">Rp. ' . $price . '</span>
               </div>
           </div>
           <p>' . $description . '</p>
           <div class="row d-flex flex-wrap">
               <div class="col-12 col-md-6 col-lg-6 mb-3">
                   <a href="' . base_url('produk/detail/' . $id) . '" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i> Detail Produk</a>
               </div>
               <div class="col-6 col-md-6 col-lg-6">
                   <button id="produk' . $id . '"  onclick= " addToCart(`' . $id . '`, `' . $price . '`, `' . $image . '`, `' . $weight . '`, `' . $name . '`)"  type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-cart-plus"></i> Keranjang</button>

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

function product_carousel_detail(
    string $image,

) {
    $element = '
                <div class="item wow">
                <img style="max-width: 200px; border: 1px solid #ccc" class="img-product" src="' . base_url('uploads/foto-product/' . $image) . '" alt="' . $image . '">
                </div>
    ';
    return $element;
}

function item_expedisi(
    string $id,
    string $name
) {
    $element = '<li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="' . $id . '" class="custom-control-input" id="' . $id . '">
                        <label class="custom-control-label" for="' . $id . '">' . $name . '</label>
                    </div>
                </li>';

    return $element;
}

function cart_list(
    string $image,
    string $name,
    string $qty,
    string $id
) {
    $element = '
    <div class="d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #dee2e6;">
        <div class="d-inline p-3">
            <img class="img-fluid rounded" style="width: 120px;" src="' . base_url('uploads/foto-product/' . $image . '') . '" alt="produk ' . $id . '">
        </div>
        <span class="d-inline text-truncate p-2" style="max-width: 150px;">
          ' . $name . '
        </span>
        <div class="d-inline p-3 d-flex justify-content-center">
            <button  onclick="min_qty(' . $id . ')" type="button" class="btn btn-primary btn-sm"><i class="fas fa-minus"></i></button>
            <input id="qty' . $id . '" type="text" value="' . $qty . '" class="qty">
            <button onclick="add_qty(' . $id . ')" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
        </div>
        <span class="text-danger d-inline p-3" style="cursor: pointer;">
            <i class="fas fa-trash" onclick="delete_item_cart(`' . $id . '`)"></i>
        </span>
    </div>
';

    return $element;
}
