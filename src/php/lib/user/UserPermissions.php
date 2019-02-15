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
    private $canDeleteSignedWaiver = false;

    private $canCreateWaiverEntry = false;
    private $canDeleteWaiverEntry = false;
    private $canModifyWaiverEntry = false;
    private $canDeleteWaiversByReservation = false;

    private $canAssignReservationId = false;
    private $canUnassignedReservationId = false;

    private $canCreateUser = false;
    private $canDeleteUser = false;
    private $canModifyUser = false;
    private $canViewUsers = false;
    private $isSuperUser = false;

    function __construct(string $permStr)
    {
        if (!empty($permStr)) {
            $source = json_decode($permStr, true);
            $this->canCreateVenue = $source['createVenue'];
            $this->canDeleteVenue = $source['deleteVenue'];
            $this->canModifyVenue = $source['modifyVenue'];
            $this->canCreateWaiver = $source['createWaiver'];
            $this->canDeleteWaiver = $source['deleteWaiver'];
            $this->canModifyWaiver = $source['modifyWaiver'];

            $this->canViewSignedWaiverbase = $source['ViewSignedWaivers'];
            $this->canViewWaiverbaseUnsigned = $source['ViewUnsignedWaivers'];
            $this->canDeleteSignedWaiver = $source['DeleteSignedWaiver'];

            $this->canCreateWaiverEntry = $source['createNewWaiverEntry'];
            $this->canDeleteWaiver = $source['deletePendingWaiverEntry'];
            $this->canDeleteWaiversByReservation = $source['deleteWaiversByReservation'];

            $this->canAssignReservationId = $source['assignReservationId'];
            $this->canUnassignedReservationId = $source['unassignReservationId'];

            $this->canCreateUser = $source['createUser'];
            $this->canDeleteUser = $source['deleteUser'];
            $this->canModifyUser = $source['modifyUser'];
            $this->canViewUsers = $source['viewUsers'];
            $this->isSuperUser = $source['superUser'];
        }
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
    public function CanViewUsers(): bool
    {
        return $this->canViewUsers;
    }

    /**
     * @param bool $canViewUsers
     *
     * @return UserPermissions
     */
    public function setCanViewUsers(bool $canViewUsers): UserPermissions
    {
        $this->canViewUsers = $canViewUsers;
        return $this;
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
        return $this->canDeleteSignedWaiver;
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
        return $this->canUnassignedReservationId;
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
     * @param bool $canDeleteSignedWaiver
     * @return UserPermissions
     */
    public function setCanDeleteSignedWaiver(bool $canDeleteSignedWaiver): UserPermissions
    {
        $this->canDeleteSignedWaiver = $canDeleteSignedWaiver;
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
     * @return bool
     */
    public function CanDeleteWaiversByReservation(): bool
    {
        return $this->canDeleteWaiversByReservation;
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
     * @return UserPermissions
     */
    public function setCanModifyUser(bool $canModifyUser): UserPermissions
    {
        $this->canModifyUser = $canModifyUser;
        return $this;
    }

    /**
     * @param bool $canDeleteWaiversByReservation
     *
     * @return UserPermissions
     */
    public function setCanDeleteWaiversByReservation(bool $canDeleteWaiversByReservation): UserPermissions
    {
        $this->canDeleteWaiversByReservation = $canDeleteWaiversByReservation;
        return $this;
    }

    /**
     * @param bool $canModifyVenue
     * @return UserPermissions
     */
    public function setCanModifyVenue(bool $canModifyVenue): UserPermissions
    {
        $this->canModifyVenue = $canModifyVenue;
        return $this;
    }

    /**
     * @param bool $canModifyWaiver
     * @return UserPermissions
     */
    public function setCanModifyWaiver(bool $canModifyWaiver): UserPermissions
    {
        $this->canModifyWaiver = $canModifyWaiver;
        return $this;
    }

    /**
     * @param bool $canModifyWaiverEntry
     * @return UserPermissions
     */
    public function setCanModifyWaiverEntry(bool $canModifyWaiverEntry): UserPermissions
    {
        $this->canModifyWaiverEntry = $canModifyWaiverEntry;
        return $this;
    }

    /**
     * @param bool $canViewSignedWaiverbase
     * @return UserPermissions
     */
    public function setCanViewSignedWaiverbase(bool $canViewSignedWaiverbase): UserPermissions
    {
        $this->canViewSignedWaiverbase = $canViewSignedWaiverbase;
        return $this;
    }

    /**
     * @param bool $canViewWaiverbaseUnsigned
     * @return UserPermissions
     */
    public function setCanViewWaiverbaseUnsigned(bool $canViewWaiverbaseUnsigned): UserPermissions
    {
        $this->canViewWaiverbaseUnsigned = $canViewWaiverbaseUnsigned;
        return $this;
    }

    /**
     * @param bool $canUnassignedReservationId
     * @return UserPermissions
     */
    public function setCanUnassignedReservationId(bool $canUnassignedReservationId): UserPermissions
    {
        $this->canUnassignedReservationId = $canUnassignedReservationId;
        return $this;
    }

    /**
     * @param bool $isSuperUser
     * @return UserPermissions
     */
    public function setSuperUser(bool $isSuperUser): UserPermissions
    {
        $this->isSuperUser = $isSuperUser;
        return $this;
    }

    public function toJSON(): string
    {
        $json['createVenue'] = $this->canCreateVenue;
        $json['deleteVenue'] = $this->canDeleteVenue;
        $json['modifyVenue'] = $this->canModifyVenue;

        $json['createWaiver'] = $this->canCreateWaiver;
        $json['deleteWaiver'] = $this->canDeleteWaiver;
        $json['modifyWaiver'] = $this->canModifyWaiver;

        $json['ViewSignedWaivers'] = $this->canViewSignedWaiverbase;
        $json['ViewUnsignedWaivers'] = $this->canViewWaiverbaseUnsigned;
        $json['DeleteSignedWaiver'] = $this->canDeleteSignedWaiver;

        $json['createNewWaiverEntry'] = $this->canCreateWaiverEntry;
        $json['deletePendingWaiverEntry'] = $this->canDeleteWaiver;
        $json['deleteWaiversByReservation'] = $this->canDeleteWaiversByReservation;

        $json['assignReservationId'] = $this->canAssignReservationId;
        $json['unassignReservationId'] = $this->canUnassignedReservationId;

        $json['createUser'] = $this->canCreateUser;
        $json['deleteUser'] = $this->canDeleteUser;
        $json['modifyUser'] = $this->canModifyUser;
        $json['viewUsers'] = $this->canViewUsers;
        $json['superUser'] = $this->isSuperUser;
        return json_encode($json);
    }
}