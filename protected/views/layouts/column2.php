<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="row clearfix">
    
    <div class="col-lg-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
            </span>
        </div>
        
        <div class="sidebar">
            <h4 class="widget-title">
                Product Categories
            </h4>
            <ul class="product-categories"><li class="cat-item cat-item-45"><a class="sidebars"  href="http://www.mooseblvr.com/product-category/accessories/">Accessories</a></li>
                <li class="cat-item cat-item-61"><a  class="sidebars"  href="http://www.mooseblvr.com/product-category/bags/">Bags</a></li>
                <li class="cat-item cat-item-60"><a  class="sidebars"  href="http://www.mooseblvr.com/product-category/bottoms/">Bottoms</a></li>
                <li class="cat-item cat-item-47"><a  class="sidebars" href="http://www.mooseblvr.com/product-category/gadgets/">Gadgets</a></li>
                <li class="cat-item cat-item-49"><a class="sidebars" href="http://www.mooseblvr.com/product-category/mens-clothing/">Men's Clothing</a></li>
                <li class="cat-item cat-item-63"><a class="sidebars" href="http://www.mooseblvr.com/product-category/merchandises/">Merchandises</a></li>
                <li class="cat-item cat-item-59"><a class="sidebars" href="http://www.mooseblvr.com/product-category/outerwears/">Outerwears</a></li>
                <li class="cat-item cat-item-57"><a class="sidebars" href="http://www.mooseblvr.com/product-category/shirts-polo/">Shirts &amp; Polo</a></li>
                <li class="cat-item cat-item-62"><a class="sidebars" href="http://www.mooseblvr.com/product-category/shoes/">Shoes</a></li>
                <li class="cat-item cat-item-56"><a class="sidebars" href="http://www.mooseblvr.com/product-category/t-shirt/">T Shirt</a></li>
                <li class="cat-item cat-item-58"><a class="sidebars" href="http://www.mooseblvr.com/product-category/tops-dresses/">Tops &amp; Dresses</a></li>
            </ul>
        </div>
        <div class="sidebar" style="color:#515151;">
        <h4 class="widget-title">Hubungi Kami</h4>
        <small>
            Moose Believer
            <br />
            Distribution Center & Store
            Jl Perdana Blok I/11, Jaksel
            Indonesia
            <br /><br />
            Online Store<br />
            Phone: 087888027573<br />
            Whatsapp: 087771419430<br />
            Blackberry: 79D7F738<br />
            <br />
            order@mooseblvr.com
        </small>
        </div>
        
    </div>
    
    <div class="col-lg-9">
	<?php echo $content; ?>
    </div>
</div>

<?php $this->endContent(); ?>