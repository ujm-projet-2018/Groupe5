<?php


namespace Bagshare\Domain;


use Bagshare\Domain\DateFormater;

/**
 * 
 * Auteur : S.RABONARIJAONA
 * 
 */

class Reservation {

	/**
	 * 
	 * @var Offre
	 * @access private
	 */
	private  $offre;

	/**
	 * 
	 * @var User
	 * @access private
	 */
	private  $user;

	/**
	 * 
	 * @var int
	 * @access private
	 */
	private  $nb_kg;

	/**
	 * 
	 * @var int
	 * @access private
	 */
	private  $nb_env;

	/**
	 * 
	 * @var Avis
	 * @access private
	 */
	private  $avis_client;

	/**
	 * 
	 * @var Avis
	 * @access private
	 */
	private  $avis_vendeur;

	/**
	 * 
	 * @var String
	 * @access private
	 */
	private  $date_reservation;

	/**
	 * 
	 * @var boolean
	 * @access private
	 */
	private  $est_confirme;

	/**
	 * 
	 * @var Article[]
	 * @access private
	 */
	private  $article_array;
    
    
    /* constructor */
    public function __construct(array $row){
        $this->hydrate($row);
    }
    
    /* hydrator */
    private function hydrate(array $row){
        foreach ($row as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }


	/**
	 * @access public
	 * @return Offre
	 */

	public final  function getOffre() {
        return $this->offre;
	}


	/**
	 * @access public
	 * @return User
	 */

	public final  function getUser() {
        return $this->user;
	}


	/**
	 * @access public
	 * @return int
	 */

	public final  function getNb_kg() {
        return $this->nb_kg;
	}


	/**
	 * @access public
	 * @return int
	 */

	public final  function getNb_env() {
        return $this->nb_env;
	}


	/**
	 * @access public
	 * @return Avis
	 */

	public final  function getAvis_client() {
        return $this->avis_client;
	}


	/**
	 * @access public
	 * @return Avis
	 */

	public final  function getAvis_vendeur() {
        return $this->avis_vendeur;
	}


	/**
	 * @access public
	 * @return Date
	 */

	public final  function getDate_reservation() {
        return DateFormater::formaterDate($this->date_reservation);
	}


	/**
	 * @access public
	 * @return boolean
	 */

	public final  function getEst_confirme() {
        return est_confirme;
	}


	/**
	 * @access public
	 * @return Article[]
	 */

	public final  function getArticle_array() {
        return article_array;
	}


	/**
	 * @access public
	 * @param Offre $offre 
	 * @return void
	 */

	public final  function setOffre(Offre $offre) {
        $this->offre = $offre;
        return null !== $this->offre;
	}


	/**
	 * @access public
	 * @param User $user 
	 * @return void
	 */

	public final  function setUser(User $user) {
        $this->user = $user;
        return null !== $this->user;
	}


	/**
	 * @access public
	 * @param int $nb_kg 
	 * @return void
	 */

	public final  function setNb_kg($nb_kg) {
        $this->nb_kg = (int)$nb_kg;
        return null !== $this->nb_kg;
	}


	/**
	 * @access public
	 * @param int $nb_env 
	 * @return void
	 */

	public final  function setNb_env($nb_env) {
        $this->nb_env = (int)$nb_env;
        return null !== $this->nb_env;
	}


	/**
	 * @access public
	 * @param Avis $avis 
	 * @return void
	 */

	public final  function setAvis_client(Avis $avis) {
        $this->avis_client = $avis;
        return null !== $this->avis_client;
	}


	/**
	 * @access public
	 * @param Avis $avis 
	 * @return void
	 */

	public final  function setAvis_vendeur(Avis $avis) {
        $this->avis_vendeur = $avis;
        return null !== $this->avis;
	}


	/**
	 * @access public
	 * @param Date $date 
	 * @return void
	 */

	public final  function setDate_reservation($date) {
        $this->date_reservation = DateFormater::setDate($date);
        return null !== $this->date_reservation;
	}


	/**
	 * @access public
	 * @param boolean $confirme 
	 * @return void
	 */

	public final  function setEst_confirme($confirme) {
        $this->est_confirme = (boolean)confirme;
        return null !== $this->est_confirme;
	}


	/**
	 * @access public
	 * @param Article[] $articles 
	 * @return void
	 */

	public final  function setArticle_array(Article[] $articles) {
        $this->article_array = $articles;
        return null !== $this->article_array;
	}


}
