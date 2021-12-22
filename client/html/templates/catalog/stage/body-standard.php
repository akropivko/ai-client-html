<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2021
 */

$enc = $this->encoder();


?>
<section class="aimeos catalog-stage <?= $enc->attr( $this->get( 'stageCatPath', map() )->getConfigValue( 'css-class', '' )->join( ' ' ) ) ?>"
	data-jsonurl="<?= $enc->attr( $this->link( 'client/jsonapi/url' ) ) ?>">

	<?php if( isset( $this->stageErrorList ) ) : ?>
		<ul class="error-list">
			<?php foreach( (array) $this->stageErrorList as $errmsg ) : ?>
				<li class="error-item"><?= $enc->html( $errmsg ) ?></li>
			<?php endforeach ?>
		</ul>
	<?php endif ?>


	<?php if( !$this->param( 'd_prodid', $this->param( 'd_name' ) ) && ( $catItem = $this->get( 'stageCurrentCatItem' ) ) && !( $mediaItems = $catItem->getRefItems( 'media', 'stage', 'default' ) )->isEmpty() ) : ?>
		<div class="catalog-stage-image single-item">

			<?php foreach( $mediaItems as $mediaItem ) : ?>
				<div class="stage-item">
					<img alt="<?= $enc->attr( $mediaItem->getProperties( 'title' )->first() ) ?>"
						src="<?= $enc->attr( $this->content( $mediaItem->getPreview( true ), $mediaItem->getFileSystem() ) ) ?>"
						srcset="<?= $enc->attr( $this->imageset( $mediaItem->getPreviews(), $mediaItem->getFileSystem() ) ) ?>"
					>
				</div>
			<?php endforeach ?>

		</div>
	<?php endif ?>

	<div class="catalog-stage-breadcrumb">
		<nav class="breadcrumb">
			<span class="title"><?= $enc->html( $this->translate( 'client', 'You are here:' ), $enc::TRUST ) ?></span>
			<ol>

				<?php if( isset( $this->stageCatPath ) ) : ?>
					<?php foreach( $this->get( 'stageCatPath', map() ) as $cat ) : ?>
						<li>
							<a href="<?= $enc->attr( $this->link( 'client/html/catalog/tree/url', array_merge( $this->get( 'stageParams', [] ), ['f_name' => $cat->getName( 'url' ), 'f_catid' => $cat->getId()] ) ) ) ?>">
								<?= $enc->html( $cat->getName() ) ?>
							</a>
						</li>
					<?php endforeach ?>
				<?php else : ?>
					<li>
						<a href="<?= $enc->attr( $this->link( 'client/html/catalog/lists/url', $this->get( 'stageParams', [] ) ) ) ?>">
							<?= $enc->html( $this->translate( 'client', 'Your search result' ), $enc::TRUST ) ?>
						</a>
					</li>
				<?php endif ?>

			</ol>
		</nav>
	</div>


	<?= $this->block()->get( 'catalog/stage/navigator' ) ?>

</section>
