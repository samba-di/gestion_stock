<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <h2>Notification <span class="notifs">(0)</span></h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="produit">
                        <h3>Products</h3>

                        <?php
                            if (DB::connection()->getPdo()){
                                $prod = DB::select("SELECT * FROM produits");
                                if(count( $prod)<=0){
                                    echo('<p class="no_products">No products founds</p>');
                                }
                                else{
                                    while($produit = $prod->fetch()){
                                        echo "Products founds !";
                                    }
                                }
                            }
                        ?>
                        <a href="#addproduct" class="prod" onclick="addprod()">Add or remove products </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        if(isset($_GET['prod']) && isset($_GET['qte']) && isset($_GET['add']) && !(empty($_GET['prod']) && empty($_GET['qte'])&& empty($_GET['add']))){
            if ($_GET['add']=="add"){
                if (DB::connection()->getPdo()) {
                    DB::insert('INSERT INTO produits(nom_produit,quantite) VALUES(?,?)', [$_GET['prod'],$_GET['qte']]);
                    $select=DB::select('SELECT id_produit FROM produits WHERE nom_produit = ?', [$_GET['prod']]);
                    DB::insert('INSERT INTO stock(date_entree,quantite_entree,user_id, id_produit,created_at) VALUES(now(),?,?,?,now()',[$_GET['qte'],Auth::user()->id,$select]);
                    header('location: dashboard');
                }
            }
            else{

            }
        }
        
    ?>
    <div id="addproduct">

        <form action="" method="GET">
            <h1> Add or remove products</h1>
            <div id="champs">

            <div>
                <label for="name">Name of product :</label><br>
                <?php

                    if(DB::connection()->getPdo()){
                                $prods = DB::select("SELECT * FROM produits");
                                if(count($prods)<=0){ ?>
                                    <input type="text" name="prod" id="name" required>
                                <?php }
                                else{
                                    echo "<select name='produit' required><option value=''>Select product</option>";
                                    while($produit = $prods->fetch()){
                                        echo "<option value='".$produit['id_produit']."'>".$produit['nom_produit']."</option>";
                                    }
                                    echo "</select>";
                                }
                    }
                ?>
            </div>
            <div>
                <label for="qte">Quantity :</label><br>
                <input type="number" name="qte" id="qte" required>
            </div>

            </div>
            <input type="radio" name="add" id="add"  value="add" required><label for="add"> Add this quantity for this product</label> <br>
            <input type="radio" name="add" id="remo" value="remo"><label for="remo"> Remove this quantity for this product</label> <br>
            <div id="btn">
                <span id="button" onclick="addprod()">Close</span>
            <input type="submit" value="Save">

            </div>
        </form>
    </div>
    <script>
        function addprod(){
            document.getElementById('addproduct').classList.toggle('active');
        }
    </script>
    <style>
        .prod{
            padding: 5px 15px;
            background: royalblue;
            color: #fff;
            display: inline-block;
            margin: 10px 0;
            border-radius: 5px;
        }
        #addproduct{
            width: 100%;
            height: 100vh;
            background: #c3c4c3;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            opacity: 0;
        }
        #addproduct.active{

            visibility: visible;
            opacity: 1;
            transition: .5s ease-in;
        }
        form{
            position: relative;
            width: 60%;
            height: 60%;
            background: rgb(238, 230, 230);
            padding: 60px 90px;
            border-radius: 10px;
            box-shadow: 2px 2px 5px #0002, -2px -2px 5px #0002;
        }
        form h1{
            font-size: 33px;


        }
        form #champs{
            display: flex;
            margin: 20px 0 10px;



        }
        form #champs div {
            margin: 0 10px ;
        }
        #btn{
            position: absolute;
            bottom: 60PX;
            right: 90px;

        }
        #button{
            display: inline-block;
            margin: 0 15px ;
            border-radius: 5px;
            padding: 5px 15px;
            background-color: rgb(245, 70, 70);
            color: #ffe;
        }
        #btn input{

            border-radius: 5px;
            padding: 5px 15px;
            background-color: rgb(3, 209, 3);
            color: #ffe;
        }



    </style>
</x-app-layout>
