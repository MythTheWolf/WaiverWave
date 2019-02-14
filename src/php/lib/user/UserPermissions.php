<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/user/UserPermissions.php";

/**
 * Created by PhpStorm.
 * User: nicholasagner
 * Date: 2019-02-14
 * Time: 12:48
 */
class UserPermissions
{
    private $canCreateVenue = false;
    private $canDeleteVenue = false;
    private $canModifyVenue = false;

    private $canCreateWaiver = false;
    private $canDeleteWaiver = false;
    private $canModifyWaiver = false;

    private $canViewWaiverbaseUnsigned = false;
    private $canViewSignedWaiverbase = false;
    private $canDeleteFromWaiverbase = false;

    private $canCreateWaiverEntry = false;
    private $canDeleteWaiverEntry = false;
    private $canModifyWaiverEntry = false;

    private $canAssignReservationId = false;
    private $caUnassignReservationId = false;

    private $canCreateUser = false;
    private $canDeleteUser = false;
    private $canModifyUser = false;

    private $isSuperUser = false;

    function __construct(WaiverWaveUser $user)
    {

    }

    /**
     * @return bool
     */
    public function AssignReservationId(): bool
    {
        return $this->canAssignReservationId;
    }

    /**
     * @return bool
     */
    public function CanCreateUser(): bool
    {
        return $this->canCreateUser;
    }

    /**
     * @return bool
     */
    public function CanCreateVenue(): bool
    {
        return $this->canCreateVenue;
    }

    /**
     * @return bool
     */
    public function CanCreateWaiver(): bool
    {
        return $this->canCreateWaiver;
    }

    /**
     * @return bool
     */
    public function CanCreateWaiverEntry(): bool
    {
        return $this->canCreateWaiverEntry;
    }

    /**
     * @return bool
     */
    public function CanDeleteFromWaiverbase(): bool
    {
        return $this->canDeleteFromWaiverbase;
    }

    /**
     * @return bool
     */
    public function CanDeleteUser(): bool
    {
        return $this->canDeleteUser;
    }

    /**
     * @return bool
     */
    public function CanDeleteVenue(): bool
    {
        return $this->canDeleteVenue;
    }

    /**
     * @return bool
     */
    public function CanDeleteWaiver(): bool
    {
        return $this->canDeleteWaiver;
    }

    /**
     * @return bool
     */
    public function CanDeleteWaiverEntry(): bool
    {
        return $this->canDeleteWaiverEntry;
    }

    /**
     * @return bool
     */
    public function CanModifyUser(): bool
    {
        return $this->canModifyUser;
    }

    /**
     * @return bool
     */
    public function CanModifyVenue(): bool
    {
        return $this->canModifyVenue;
    }

    /**
     * @return bool
     */
    public function CanModifyWaiver(): bool
    {
        return $this->canModifyWaiver;
    }

    /**
     * @return bool
     */
    public function CanModifyWaiverEntry(): bool
    {
        return $this->canModifyWaiverEntry;
    }

    /**
     * @return bool
     */
    public function CanViewSignedWaiverbase(): bool
    {
        return $this->canViewSignedWaiverbase;
    }

    /**
     * @return bool
     */
    public function CanViewWaiverbaseUnsigned(): bool
    {
        return $this->canViewWaiverbaseUnsigned;
    }

    /**
     * @return bool
     */
    public function CanUnassignReservationId(): bool
    {
        return $this->caUnassignReservationId;
    }

    /**
     * @return bool
     */
    public function SuperUser(): bool
    {
        return $this->isSuperUser;
    }

    /**
     * @param bool $canAssignReservationId
     * @return UserPermissions
     */
    public function setCanAssignReservationId(bool $canAssignReservationId): UserPermissions
    {
        $this->canAssignReservationId = $canAssignReservationId;
        return $this;
    }

    /**
     * @param bool $canCreateUser
     * @return UserPermissions
     */
    public function setCanCreateUser(bool $canCreateUser): UserPermissions
    {
        $this->canCreateUser = $canCreateUser;
        return $this;
    }

    /**
     * @param bool $canCreateVenue
     * @return UserPermissions
     */
    public function setCanCreateVenue(bool $canCreateVenue): UserPermissions
    {
        $this->canCreateVenue = $canCreateVenue;
        return $this;
    }

    /**
     * @param bool $canCreateWaiver
     * @return UserPermissions
     */
    public function setCanCreateWaiver(bool $canCreateWaiver): UserPermissions
    {
        $this->canCreateWaiver = $canCreateWaiver;
        return $this;
    }

    /**
     * @param bool $canCreateWaiverEntry
     *
     * @return UserPermissions
     */
    public function setCanCreateWaiverEntry(bool $canCreateWaiverEntry): UserPermissions
    {
        $this->canCreateWaiverEntry = $canCreateWaiverEntry;
        return $this;
    }

    /**
     * @param bool $canDeleteFromWaiverbase
     * @return UserPermissions
     */
    public function setCanDeleteFromWaiverbase(bool $canDeleteFromWaiverbase): UserPermissions
    {
        $this->canDeleteFromWaiverbase = $canDeleteFromWaiverbase;
        return $this;
    }

    /**
     * @param bool $canDeleteUser
     * @return UserPermissions
     */
    public function setCanDeleteUser(bool $canDeleteUser): UserPermissions
    {
        $this->canDeleteUser = $canDeleteUser;
        return $this;
    }

    /**
     * @param bool $canDeleteVenue
     * @return UserPermissions
     */
    public function setCanDeleteVenue(bool $canDeleteVenue): UserPermissions
    {
        $this->canDeleteVenue = $canDeleteVenue;
        return $this;
    }

    /**
     * @param bool $canDeleteWaiver
     * @return UserPermissions
     */
    public function setCanDeleteWaiver(bool $canDeleteWaiver): UserPermissions
    {
        $this->canDeleteWaiver = $canDeleteWaiver;
        return $this;
    }

    /**
     * @param bool $canDeleteWaiverEntry
     * @return UserPermissions
     */
    public function setCanDeleteWaiverEntry(bool $canDeleteWaiverEntry): UserPermissions
    {
        $this->canDeleteWaiverEntry = $canDeleteWaiverEntry;
        return $this;
    }

    /**
     * @param bool $canModifyUser
     */
    public function setCanModifyUser(bool $canModifyUser)
    {
        $this->canModifyUser = $canModifyUser;
    }

}