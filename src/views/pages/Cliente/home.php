<?php use \src\Config;?>

<div class="slide carousel body-js" id="slideShow">
    <div class="carousel-inner" >
        <div class="carousel-item active">
            <img src="<?php echo Config::BASE_DIR;?>/assets/img/slide1.jpg" class="w-100" />
        </div>
        <div class="carousel-item">
            <img src="<?php echo Config::BASE_DIR;?>/assets/img/slide2.jpg" class="w-100" />
        </div>
        <div class="carousel-item">
            <img src="<?php echo Config::BASE_DIR;?>/assets/img/slide3.jpg" class="w-100" />
        </div>
    </div>
    <a class="carousel-control-prev" href="#slideShow" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#slideShow" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>

<section id="produtos">
    <div class="p-1 bg-dark text-white text-center">
        <h3>Produtos</h3>
    </div>
    <div class="navbar navbar-dark bg-dark">
        <div class="container d-flex justify-content-center">
            <div class="input-group mb-3" style="width: 200px;">
                <div class="input-group-prepend">
                    <label class="input-group-text bg-primary text-white" for="inputGroupSelect01">Categorias</label>
                </div>
                <select class="custom-select filtrosCategorias-js" id="inputGroupSelect01">
                    <option></option>
                    <option value="todos">Todos</option>
                    <option value="bolo">Bolos</option>
                    <option value="doce">Doces</option>
                    <option value="kitFesta">Kit-festas</option>
                </select>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">

        <!-- //mostrar os produtos recebidos do controller-->
        <?php 
        $produtos = $produtos ?? [];
        foreach($produtos as $produto):
        ?>

            <div class="col-md-4">
                    <div class="card card-js" style="margin-top: 20px;">
                        <div class="card-text text-center text-white" style="background-color: #368986;">
                        <!-- //mostrar o id do produto-->    
                        <input type="hidden" class="id-js" value="<?php echo $produto['id'];?>">
                        <!-- //mostrar o caetgoria do produto-->    
                        <input type="hidden" class="categoria-js" value="<?php echo $produto['categoria'];?>">
                        <!-- //mostrar o nome do produto-->    
                        <h5 class="nome-js"> <?php echo $produto['nome'];?> </h5>
                        </div>
                        <!-- //mostrar a imagem do produto--> 
                        <img src="<?php echo Config::BASE_DIR;?>/assets/img/produtos/<?php echo $produto['imagem'].'.jpg';?>" class="card-img-top imagem-js" alt="..." height="200px">
                        <div class="card-body" style="background-color: #ccc;">
                            <!-- //mostrar o valor do produto--> 
                            <h5 class="card-title text-center">R$ <span class="preco-js"><?php echo $produto['preco'];?></span></h5>
                            <!-- //mostrar a descrição do produto--> 
                            <p class="card-text descricao-js"> <?php echo $produto['descricao'];?> </p>

                            <div class="d-flex justify-content-between">
                                <div class="btn-group botoes-js">
                                    <button class="btn btn-primary diminuir-js">-</button>
                                    <button class="btn btn-primary quantidade-js">1</button>
                                    <button class="btn btn-primary aumentar-js">+</button>
                                </div>
                                <div>
                                    <a href="" class="btn btn-primary adicionar-js">Adicionar</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        
        <?php endforeach;?>
            
        </div>
    </div>
</section>


