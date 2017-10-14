<?php
/**
 * VectorX - Modern version of MonoBook with fresh look and many usability
 * improvements.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup Skins
 */

/**
 * SkinTemplate class for VectorX skin
 * @ingroup Skins
 */
class SkinVectorX extends SkinTemplate {
	public $skinname = 'vectorx';
	public $stylename = 'VectorX';
	public $template = 'VectorXTemplate';
	/**
	 * @var Config
	 */
	private $vectorxConfig;

	public function __construct() {
		$this->vectorxConfig = ConfigFactory::getDefaultInstance()->makeConfig( 'vectorx' );
	}

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param OutputPage $out Object to initialize
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );

		if ( $this->vectorxConfig->get( 'VectorXResponsive' ) ) {
			$out->addMeta( 'viewport', 'width=device-width, initial-scale=1' );
			$out->addModuleStyles( 'skins.vectorx.styles.responsive' );
		}

		$out->addModules( 'skins.vectorx.js' );
	}

	/**
	 * Loads skin and user CSS files.
	 * @param OutputPage $out
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		// mediawiki.skinning.interface manually included in screen.less
		// resources/Resources.php
		/*// Used in the web installer. Test it after modifying this definition!
	'mediawiki.skinning.interface' => [
		'class' => 'ResourceLoaderSkinModule',
		'styles' => [
			'resources/src/mediawiki.skinning/elements.css' => [ 'media' => 'screen' ],
			'resources/src/mediawiki.skinning/content.css' => [ 'media' => 'screen' ],
			'resources/src/mediawiki.skinning/interface.css' => [ 'media' => 'screen' ],
		],
	],*/
		$styles = [ /*'mediawiki.skinning.interface',*/ 'skins.vectorx.styleswithclass', 'skins.vectorx.styles' ];
		Hooks::run( 'SkinVectorXStyleModules', [ $this, &$styles ] );
		$out->addModuleStyles( $styles );
	}

	/**
	 * Override to pass our Config instance to it
	 */
	public function setupTemplate( $classname, $repository = false, $cache_dir = false ) {
		return new $classname( $this->vectorxConfig );
	}
}
