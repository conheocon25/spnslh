<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $obj );
    function insert( Object $obj );
    //function delete();
}

interface AppFinder  extends Finder {}

interface CategoryAdsFinder  extends Finder {}
interface AdsFinder  extends Finder {}

interface UserFinder  extends Finder {}
interface GuestFinder  extends Finder{}
interface ContactFinder  extends Finder{}

interface PageFinder  extends Finder{}

interface ProvinceFinder  extends Finder{}
interface DistrictFinder  extends Finder{}

interface AgencyFinder  extends Finder {}
interface AgencyMarketFinder  extends Finder {}

interface CategoryEstateFinder  extends Finder {}

interface CategoryKnowledgeFinder  extends Finder {}
interface NewsKnowledgeFinder  extends Finder {}

interface CategoryGeneralFinder  extends Finder {}
interface NewsGeneralFinder  extends Finder {}

interface CategoryMarketFinder  extends Finder {}
interface NewsMarketFinder  extends Finder {}

interface CategoryProjectFinder  extends Finder {}
interface ProjectFinder  extends Finder {}
interface ProjectProductFinder  extends Finder {}
interface ProjectAlbumFinder  extends Finder {}
interface ProjectVideoFinder  extends Finder {}
interface ProjectDocFinder  extends Finder {}

interface NewsProjectFinder  extends Finder {}
?>