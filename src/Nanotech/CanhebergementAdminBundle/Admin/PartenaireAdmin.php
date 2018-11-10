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
             ->add('coordx')
            ->add('coordy')
            ->add('pays')
            ->add('ville')
            ->add('quartier')                
            ->add('adrComplete')
            ->add('numTel1')
            ->add('numTel2')
            ->add('numTel3')
            ->add('faxTel')
            ->add('boitPost')
            ->add('adrEmail')
            ->add('adrServ')          
            ->add('service')
            ->add('proximite')
           ->add('logo', 'sonata_media_type', array(
                   'provider' => 'sonata.media.provider.image',
                   'context' => 'logo_moyen_paiement',
                   'required' => false,
                   'label' => "logo du partenaire",
               ))
           
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
            ->add('descriptionFr')
            ->add('descriptionEn')
        ;
    }
}
