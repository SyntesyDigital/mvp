<?php $__env->startSection('content'); ?>
  <div class="banner banner-small offer-banner" style="background-image:url('<?php echo e(asset('modules/bwo/images/blog-banner.jpg')); ?>')">
    <div class="horizontal-inner-container">
        <h1>ACTUALITÉ</h1>
      </div>
    </div>
  </div>
  <div class="posts-container">
    <div class="horizontal-inner-container post-container">
        <ul class="breadcrumb">
          <li><a href="<?php echo e(route('home')); ?>">ACCUEIL</a></li>
          <li><a href="<?php echo e(route('blog')); ?>">ACTUALITÉS</a></li>
          <li><a href="<?php echo e(route('blog')); ?>">CATÉGORUE</a></li>
          <li>TITRE ACTUALITÉ</li>
        </ul>
        <h1>TITRE ACTUALITÉ</h1>

        <div class="description">
          <div class="col-sm-6 first-line">
            <p class="first-info"><a href="#" class="btn btn-soft-gray">CATEGORIE</a> Le 26 novembre 2018 par auteur</p>
          </div>
          <div class="col-sm-6 first-line">
            <div class="share-container">
              <?php
                $shareUrl = '';
                $title = '';
                $description =  '';
              ?>
               Partager:
               <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($shareUrl); ?>&t=<?php echo e($title); ?>"
        					class="share-button"
        					 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
        					 target="_blank" title="Share on Facebook">
        					<img src="<?php echo e(asset('modules/bwo/images/fb_icon.jpg')); ?>" class="social-icon">
        				</a>

        				<a href="#"	class="share-button" title="Share on Instagram">
        					<img src="<?php echo e(asset('modules/bwo/images/instagram_icon.jpg')); ?>" class="social-icon">
        				</a>
                <a href="https://twitter.com/share?url=<?php echo e($shareUrl); ?>&text=<?php echo e($title); ?>"
        					class="share-button"
        					 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
        					 target="_blank" title="Share on Twitter">
        					<img src="<?php echo e(asset('modules/bwo/images/tw_icon.jpg')); ?>" class="social-icon">
        				</a>
                <a href=""
        					class="share-button">
        					<img src="<?php echo e(asset('modules/bwo/images/mail_icon.jpg')); ?>" class="social-icon">
        				</a>

            </div>
          </div>
          <br clear="all">

          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta</p>
          <p class="subtitle">PRINCIPALES MISIONS</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta</p>
          <img src="<?php echo e(asset('modules/bwo/images/post-big.jpg')); ?>"/>
        <br clear="all">
      </div>
      <div class="other-posts">
        <h3>SUR LE MÊME SUJET</h3>
        <div class="col-md-6 left-post-container">
          <div class="post-box">
              <div class="title">TITLE ACTUALITÉ</div>
              <p class="date">Le 16/11/2018 - CATÉGORIE</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vehicula at libero at ornare. Nunc at iaculis nisi, porta dapibus dolor...<a href="<?php echo e(route('post')); ?>" class="read-more">Lire la suite</a></p>
          </div>
        </div>
        <div class="col-md-6 right-post-container">
          <div class="post-box">
              <div class="title">TITLE ACTUALITÉ</div>
              <p class="date">Le 16/11/2018 - CATÉGORIE</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vehicula at libero at ornare. Nunc at iaculis nisi, porta dapibus dolor...<a href="<?php echo e(route('post')); ?>" class="read-more">Lire la suite</a></p>
          </div>
        </div>
      </div>
      <br clear="all">
    </div>
  </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts'); ?>
	<script>

    $(document).ready(function() {
        $(document).on("click","#btn-more",function() {
          $(this).hide();
          $('#btn-less').show();
          $('.light-gray-search-container').show();
        });

        $(document).on("click","#btn-less",function() {
          $(this).hide();
          $('#btn-more').show();
          $('.light-gray-search-container').hide();
        });
        $(document).ready(function() {
            $(document).on("click",".btn-search",function() {
              $(this).closest('form').submit();
            });
        });
        $(document).ready(function() {
            $(document).on("click","#btn-filtres",function() {
              $(this).closest('form').submit();
            });
        });


    });

  </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('bwo::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>