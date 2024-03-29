<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Sonata\AdminBundle\Form\Type\AdminType;

class PartenaireAdmin extends AbstractAdmin
{
     protected $baseRoutePattern = 'partenaire';
    protected $baseRouteName = 'canhebergement_partenaire';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('pays')
            ->add('ville')
            ->add('quartier')
            ->add('nbrEtoile')
            ->add('nom')
            ->add('adrComplete')
            ->add('numTel1')
            ->add('numTel2')
            ->add('numTel3')
            ->add('faxTel')
            ->add('boitPost')
            ->add('adrEmail')
            ->add('dateEnreg')
            ->add('enable')
            ->add('adrServ')
            ->add('coordx')
            ->add('coordy')
            ->add('slug')
            ->add('descriptionFr')
            ->add('descriptionEn')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nom')
            ->add('pays')
            ->add('ville')
            ->add('quartier')
            ->add('nbrEtoile')
            ->add('numTel1')
            ->add('adrEmail')
            ->add('enable')
            ->add('slug')
            ->add('utilisateur')
            ->add('dateEnreg')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Général')
                ->with('Partenaire')
                    ->add('nom')
                    ->add('categorie')
                    ->add('descriptionFr', CKEditorType::class, array(
                            'config' => array(
                                'uiColor' => '#ffffff',
                            ),
                            'label' => 'Description Française',
                            'required' => true
                        ))

                    ->add('descriptionEn', CKEditorType::class, array(
                            'config' => array(
                                'uiColor' => '#ffffff',
                            ),
                            'label' => 'Description Anglaise',
                            'required' => true
                        ))
                    ->add('nbrEtoile',null,['label' => 'Nombre Etoile','required' => true   ])
                    ->add('adrServ',null,['label' => 'Adresse Serveur'])
                ->end()
            ->end()
            ->tab('Adresse')
                ->with('Partenaire')
                    ->add('pays',CountryType::class,['required' => true])
                    ->add('ville',null,['required' => true])
                    ->add('quartier',null,['required' => true])
                    ->add('coordx',null,['label' => 'Latitude','required' => true])
                    ->add('coordy',null,['label' => 'Longitude','required' => true])
                    ->add('adrComplete',null,['label' => 'Adresse Complete','required' => true])
                    ->add('numTel1',null,['label' => 'Numero Téléphone 1','required' => true])
                    ->add('numTel2',null,['label' => 'Numero Téléphone 2'])
                    ->add('numTel3',null,['label' => 'Numero Téléphone 3'])
                    ->add('faxTel',null,['label' => 'Fax Téléphone'])
                    ->add('boitPost',null,['label' => 'Boîte Postal','required' => true])
                    ->add('adrEmail',EmailType::class,['label' => 'Adresse Email','required' => true])
                ->end()
            ->end()
            ->tab('Image')
                ->with('Partenaire')
                    ->add('logo', 'sonata_media_type', array(
                        'provider' => 'sonata.media.provider.image',
                        'context' => 'image_logo',
                        'required' => true,
                        'label' => "logo du partenaire",
                    ))

                    ->add('baniere', ModelListType::class, array(
                        'btn_list' => false,

                        'help' => 'image de la bannière de l\'hotel',
                        'required' => true
                    ), array(
                            'link_parameters' => array(
                                'context' => 'image_banniere'
                            ))
                    )

                    ->add('image', 'sonata_type_model_list', array(
                        'btn_list' => true,
                        'help' => 'image de présentation de l\'hotel',
                        'required' => true
                    ), array(
                            'link_parameters' => array(
                                'context' => 'image_partenaire'
                            ))
                    )
                ->end()
            ->end();
        if(!$this->getUser()->getPartenaire()) {
            $formMapper->tab('Autre')
                ->with('Partenaire')
                ->add('services')
                ->add('proximite')
                ->add('utilisateur')
                ->add('enable')
                ->end()
                ->end()
            ;
        }
        else{
            $formMapper->tab('Autre')
                ->with('Partenaire')
                ->add('services')
                ->add('proximite')
                ->add('utilisateur')
                ->end()
                ->end()
            ;
        }

           

    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('pays')
            ->add('ville')
            ->add('quartier')
            ->add('nbrEtoile')
            ->add('nom')
            ->add('adrComplete')
            ->add('numTel1')
            ->add('numTel2')
            ->add('numTel3')
            ->add('faxTel')
            ->add('boitPost')
            ->add('adrEmail')
            ->add('dateEnreg')
            ->add('enable')
            ->add('adrServ')
            ->add('coordx')
            ->add('coordy')
            ->add('slug')
            ->add('services')
            ->add('proximite')
            ->add('descriptionFr')
            ->add('descriptionEn')
            ->add('logo')
            ->add('image')
        ;
    }

    public function getUser()
    {
        // get container
        $container = $this->getConfigurationPool()
            ->getContainer();

        // get current user
        $user = $container->get('security.token_storage')
            ->getToken()
            ->getUser();

        return $user;
    }

    public function createQuery($context = 'list')
    {
        $user = $this->getUser();
        $query = parent::createQuery($context);
        if($user->getPartenaire()) {
            $query->andWhere(
                $query->expr()->eq($query->getRootAliases()[0] . '.id', ':id')
            );
            $query->setParameter('id', $user->getPartenaire());
        }
        return $query;
    }
}
