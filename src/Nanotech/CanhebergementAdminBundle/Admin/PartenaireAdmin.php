<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

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
            ->add('adrComplete')
            ->add('numTel1')
            ->add('adrEmail')
            ->add('dateEnreg')
            ->add('enable')
            ->add('adrServ')
            ->add('coordx')
            ->add('coordy')
            ->add('slug')
            ->add('utilisateur')
            ->add('descriptionFr')
            ->add('descriptionEn')
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
                    ->add('descriptionFr', CKEditorType::class, array(
                            'config' => array(
                                'uiColor' => '#ffffff',
                            ),
                        ))
                    ->add('descriptionEn', CKEditorType::class, array(
                            'config' => array(
                                'uiColor' => '#ffffff',
                            ),
                        ))
                    ->add('nbrEtoile')
                    ->add('adrServ')
                ->end()
            ->end()
            ->tab('Adresse')
                ->with('Partenaire')
                    ->add('pays')
                    ->add('ville')
                    ->add('quartier')
                    ->add('coordx',null,['label' => 'Latitude'])
                    ->add('coordy',null,['label' => 'Longitude'])
                    ->add('adrComplete')
                    ->add('numTel1')
                    ->add('numTel2')
                    ->add('numTel3')
                    ->add('faxTel')
                    ->add('boitPost')
                    ->add('adrEmail')
                ->end()
            ->end()
            ->tab('Image')
                ->with('Partenaire')
                    ->add('logo', 'sonata_media_type', array(
                        'provider' => 'sonata.media.provider.image',
                        'context' => 'image_logo',
                        'required' => false,
                        'label' => "logo du partenaire",
                    ))
                    ->add('image', 'sonata_type_model_list', array(
                        'btn_list' => false,
                        'help' => 'image de présentation de l\'hotel',
                    ), array(
                            'link_parameters' => array(
                                'context' => 'image_partenaire'
                            ))
                    )
                ->end()
            ->end()
            ->tab('Autre')
                ->with('Partenaire')
                    ->add('services')
                    ->add('proximite')
                    ->add('utilisateur')
                ->end()
            ->end()
        ;
           

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
