<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Model;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This file is part of the "forums" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * FrontendUser
 */
class FrontendUser extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
{

    /**
     * lastActivity
     *
     * @var \DateTime
     */
    protected $lastActivity = null;

    /**
     * how many users visited this profile
     *
     * @var int
     */
    protected $profileVisits = 0;

    /**
     * socialFacebook
     *
     * @var string
     */
    protected $socialFacebook = '';

    /**
     * socialInstagram
     *
     * @var string
     */
    protected $socialInstagram = '';

    /**
     * socialPinterest
     *
     * @var string
     */
    protected $socialPinterest = '';

    /**
     * socialTwitter
     *
     * @var string
     */
    protected $socialTwitter = '';

    /**
     * socialYoutube
     *
     * @var string
     */
    protected $socialYoutube = '';

    /**
     * preferedTimezone
     *
     * @var string
     */
    protected $preferedTimezone = '';

    /**
     * allowEmailNews
     *
     * @var bool
     */
    protected $allowEmailNews = false;

    /**
     * allowShowOnlineStatus
     *
     * @var bool
     */
    protected $allowShowOnlineStatus = false;

    /**
     * socialSteam
     *
     * @var string
     */
    protected $socialSteam = '';

    /**
     * socialXbox
     *
     * @var string
     */
    protected $socialXbox = '';

    /**
     * socialPsn
     *
     * @var string
     */
    protected $socialPsn = '';

    /**
     * socialNintendo
     *
     * @var string
     */
    protected $socialNintendo = '';

    /**
     * socialXing
     *
     * @var string
     */
    protected $socialXing = '';

    /**
     * threadsPerPage
     *
     * @var int
     */
    protected $threadsPerPage = 0;

    /**
     * postsPerPage
     *
     * @var int
     */
    protected $postsPerPage = 0;

    /**
     * subscribeToThreadAfterReply
     *
     * @var bool
     */
    protected $subscribeToThreadAfterReply = false;

    /**
     * allowDisplayEmail
     *
     * @var bool
     */
    protected $allowDisplayEmail = false;

    /**
     * cachedCounterPosts
     *
     * @var int
     */
    protected $cachedCounterPosts = 0;

    /**
     * posts
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\Post>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $posts = null;

    /**
     * threadSubscriptions
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\ThreadSubscription>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $threadSubscriptions = null;

    /**
     * signatures
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\Signature>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $signatures = null;

    /**
     * postLikes
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PostLike>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $postLikes = null;

    /**
     * pollVotes
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PollVote>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $pollVotes = null;

    /**
     * friends
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\FrontendUser>
     */
    protected $friends = null;

    /**
     * privateMessages
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PrivateMessage>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $privateMessages = null;

    /**
     * blacklistedUsers
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\FrontendUser>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $blacklistedUsers = null;

    /**
     * avatar
     *
     * @var \Weisgerber\Forums\Domain\Model\Avatar
     */
    protected $avatar = null;

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->posts = $this->posts ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->threadSubscriptions = $this->threadSubscriptions ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->signatures = $this->signatures ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->postLikes = $this->postLikes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->pollVotes = $this->pollVotes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->friends = $this->friends ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->privateMessages = $this->privateMessages ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->blacklistedUsers = $this->blacklistedUsers ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Post
     *
     * @param \Weisgerber\Forums\Domain\Model\Post $post
     * @return void
     */
    public function addPost(\Weisgerber\Forums\Domain\Model\Post $post)
    {
        $this->posts->attach($post);
    }

    /**
     * Removes a Post
     *
     * @param \Weisgerber\Forums\Domain\Model\Post $postToRemove The Post to be removed
     * @return void
     */
    public function removePost(\Weisgerber\Forums\Domain\Model\Post $postToRemove)
    {
        $this->posts->detach($postToRemove);
    }

    /**
     * Returns the posts
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\Post>
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Sets the posts
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\Post> $posts
     * @return void
     */
    public function setPosts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Adds a ThreadSubscription
     *
     * @param \Weisgerber\Forums\Domain\Model\ThreadSubscription $threadSubscription
     * @return void
     */
    public function addThreadSubscription(\Weisgerber\Forums\Domain\Model\ThreadSubscription $threadSubscription)
    {
        $this->threadSubscriptions->attach($threadSubscription);
    }

    /**
     * Removes a ThreadSubscription
     *
     * @param \Weisgerber\Forums\Domain\Model\ThreadSubscription $threadSubscriptionToRemove The ThreadSubscription to be removed
     * @return void
     */
    public function removeThreadSubscription(\Weisgerber\Forums\Domain\Model\ThreadSubscription $threadSubscriptionToRemove)
    {
        $this->threadSubscriptions->detach($threadSubscriptionToRemove);
    }

    /**
     * Returns the threadSubscriptions
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\ThreadSubscription>
     */
    public function getThreadSubscriptions()
    {
        return $this->threadSubscriptions;
    }

    /**
     * Sets the threadSubscriptions
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\ThreadSubscription> $threadSubscriptions
     * @return void
     */
    public function setThreadSubscriptions(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $threadSubscriptions)
    {
        $this->threadSubscriptions = $threadSubscriptions;
    }

    /**
     * Adds a Signature
     *
     * @param \Weisgerber\Forums\Domain\Model\Signature $signature
     * @return void
     */
    public function addSignature(\Weisgerber\Forums\Domain\Model\Signature $signature)
    {
        $this->signatures->attach($signature);
    }

    /**
     * Removes a Signature
     *
     * @param \Weisgerber\Forums\Domain\Model\Signature $signatureToRemove The Signature to be removed
     * @return void
     */
    public function removeSignature(\Weisgerber\Forums\Domain\Model\Signature $signatureToRemove)
    {
        $this->signatures->detach($signatureToRemove);
    }

    /**
     * Returns the signatures
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\Signature>
     */
    public function getSignatures()
    {
        return $this->signatures;
    }

    /**
     * Sets the signatures
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\Signature> $signatures
     * @return void
     */
    public function setSignatures(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $signatures)
    {
        $this->signatures = $signatures;
    }

    /**
     * Adds a PostLike
     *
     * @param \Weisgerber\Forums\Domain\Model\PostLike $postLike
     * @return void
     */
    public function addPostLike(\Weisgerber\Forums\Domain\Model\PostLike $postLike)
    {
        $this->postLikes->attach($postLike);
    }

    /**
     * Removes a PostLike
     *
     * @param \Weisgerber\Forums\Domain\Model\PostLike $postLikeToRemove The PostLike to be removed
     * @return void
     */
    public function removePostLike(\Weisgerber\Forums\Domain\Model\PostLike $postLikeToRemove)
    {
        $this->postLikes->detach($postLikeToRemove);
    }

    /**
     * Returns the postLikes
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PostLike>
     */
    public function getPostLikes()
    {
        return $this->postLikes;
    }

    /**
     * Sets the postLikes
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PostLike> $postLikes
     * @return void
     */
    public function setPostLikes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $postLikes)
    {
        $this->postLikes = $postLikes;
    }

    /**
     * Adds a PollVote
     *
     * @param \Weisgerber\Forums\Domain\Model\PollVote $pollVote
     * @return void
     */
    public function addPollVote(\Weisgerber\Forums\Domain\Model\PollVote $pollVote)
    {
        $this->pollVotes->attach($pollVote);
    }

    /**
     * Removes a PollVote
     *
     * @param \Weisgerber\Forums\Domain\Model\PollVote $pollVoteToRemove The PollVote to be removed
     * @return void
     */
    public function removePollVote(\Weisgerber\Forums\Domain\Model\PollVote $pollVoteToRemove)
    {
        $this->pollVotes->detach($pollVoteToRemove);
    }

    /**
     * Returns the pollVotes
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PollVote>
     */
    public function getPollVotes()
    {
        return $this->pollVotes;
    }

    /**
     * Sets the pollVotes
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PollVote> $pollVotes
     * @return void
     */
    public function setPollVotes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $pollVotes)
    {
        $this->pollVotes = $pollVotes;
    }

    /**
     * Returns the lastActivity
     *
     * @return \DateTime
     */
    public function getLastActivity()
    {
        return $this->lastActivity;
    }

    /**
     * Sets the lastActivity
     *
     * @param \DateTime $lastActivity
     * @return void
     */
    public function setLastActivity(\DateTime $lastActivity)
    {
        $this->lastActivity = $lastActivity;
    }

    /**
     * Returns the profileVisits
     *
     * @return int
     */
    public function getProfileVisits()
    {
        return $this->profileVisits;
    }

    /**
     * Sets the profileVisits
     *
     * @param int $profileVisits
     * @return void
     */
    public function setProfileVisits(int $profileVisits)
    {
        $this->profileVisits = $profileVisits;
    }

    /**
     * Adds a FrontendUser
     *
     * @param \Weisgerber\Forums\Domain\Model\FrontendUser $friend
     * @return void
     */
    public function addFriend(\Weisgerber\Forums\Domain\Model\FrontendUser $friend)
    {
        $this->friends->attach($friend);
    }

    /**
     * Removes a FrontendUser
     *
     * @param \Weisgerber\Forums\Domain\Model\FrontendUser $friendToRemove The FrontendUser to be removed
     * @return void
     */
    public function removeFriend(\Weisgerber\Forums\Domain\Model\FrontendUser $friendToRemove)
    {
        $this->friends->detach($friendToRemove);
    }

    /**
     * Returns the friends
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\FrontendUser>
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * Sets the friends
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\FrontendUser> $friends
     * @return void
     */
    public function setFriends(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $friends)
    {
        $this->friends = $friends;
    }

    /**
     * Adds a PrivateMessage
     *
     * @param \Weisgerber\Forums\Domain\Model\PrivateMessage $privateMessage
     * @return void
     */
    public function addPrivateMessage(\Weisgerber\Forums\Domain\Model\PrivateMessage $privateMessage)
    {
        $this->privateMessages->attach($privateMessage);
    }

    /**
     * Removes a PrivateMessage
     *
     * @param \Weisgerber\Forums\Domain\Model\PrivateMessage $privateMessageToRemove The PrivateMessage to be removed
     * @return void
     */
    public function removePrivateMessage(\Weisgerber\Forums\Domain\Model\PrivateMessage $privateMessageToRemove)
    {
        $this->privateMessages->detach($privateMessageToRemove);
    }

    /**
     * Returns the privateMessages
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PrivateMessage>
     */
    public function getPrivateMessages()
    {
        return $this->privateMessages;
    }

    /**
     * Sets the privateMessages
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PrivateMessage> $privateMessages
     * @return void
     */
    public function setPrivateMessages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $privateMessages)
    {
        $this->privateMessages = $privateMessages;
    }

    /**
     * Returns the socialFacebook
     *
     * @return string
     */
    public function getSocialFacebook()
    {
        return $this->socialFacebook;
    }

    /**
     * Sets the socialFacebook
     *
     * @param string $socialFacebook
     * @return void
     */
    public function setSocialFacebook(string $socialFacebook)
    {
        $this->socialFacebook = $socialFacebook;
    }

    /**
     * Returns the socialInstagram
     *
     * @return string
     */
    public function getSocialInstagram()
    {
        return $this->socialInstagram;
    }

    /**
     * Sets the socialInstagram
     *
     * @param string $socialInstagram
     * @return void
     */
    public function setSocialInstagram(string $socialInstagram)
    {
        $this->socialInstagram = $socialInstagram;
    }

    /**
     * Returns the socialPinterest
     *
     * @return string
     */
    public function getSocialPinterest()
    {
        return $this->socialPinterest;
    }

    /**
     * Sets the socialPinterest
     *
     * @param string $socialPinterest
     * @return void
     */
    public function setSocialPinterest(string $socialPinterest)
    {
        $this->socialPinterest = $socialPinterest;
    }

    /**
     * Returns the socialTwitter
     *
     * @return string
     */
    public function getSocialTwitter()
    {
        return $this->socialTwitter;
    }

    /**
     * Sets the socialTwitter
     *
     * @param string $socialTwitter
     * @return void
     */
    public function setSocialTwitter(string $socialTwitter)
    {
        $this->socialTwitter = $socialTwitter;
    }

    /**
     * Returns the socialYoutube
     *
     * @return string
     */
    public function getSocialYoutube()
    {
        return $this->socialYoutube;
    }

    /**
     * Sets the socialYoutube
     *
     * @param string $socialYoutube
     * @return void
     */
    public function setSocialYoutube(string $socialYoutube)
    {
        $this->socialYoutube = $socialYoutube;
    }

    /**
     * Returns the preferedTimezone
     *
     * @return string
     */
    public function getPreferedTimezone()
    {
        return $this->preferedTimezone;
    }

    /**
     * Sets the preferedTimezone
     *
     * @param string $preferedTimezone
     * @return void
     */
    public function setPreferedTimezone(string $preferedTimezone)
    {
        $this->preferedTimezone = $preferedTimezone;
    }

    /**
     * Returns the allowEmailNews
     *
     * @return bool
     */
    public function getAllowEmailNews()
    {
        return $this->allowEmailNews;
    }

    /**
     * Sets the allowEmailNews
     *
     * @param bool $allowEmailNews
     * @return void
     */
    public function setAllowEmailNews(bool $allowEmailNews)
    {
        $this->allowEmailNews = $allowEmailNews;
    }

    /**
     * Returns the boolean state of allowEmailNews
     *
     * @return bool
     */
    public function isAllowEmailNews()
    {
        return $this->allowEmailNews;
    }

    /**
     * Returns the allowShowOnlineStatus
     *
     * @return bool
     */
    public function getAllowShowOnlineStatus()
    {
        return $this->allowShowOnlineStatus;
    }

    /**
     * Sets the allowShowOnlineStatus
     *
     * @param bool $allowShowOnlineStatus
     * @return void
     */
    public function setAllowShowOnlineStatus(bool $allowShowOnlineStatus)
    {
        $this->allowShowOnlineStatus = $allowShowOnlineStatus;
    }

    /**
     * Returns the boolean state of allowShowOnlineStatus
     *
     * @return bool
     */
    public function isAllowShowOnlineStatus()
    {
        return $this->allowShowOnlineStatus;
    }

    /**
     * Returns the socialSteam
     *
     * @return string
     */
    public function getSocialSteam()
    {
        return $this->socialSteam;
    }

    /**
     * Sets the socialSteam
     *
     * @param string $socialSteam
     * @return void
     */
    public function setSocialSteam(string $socialSteam)
    {
        $this->socialSteam = $socialSteam;
    }

    /**
     * Returns the socialXbox
     *
     * @return string
     */
    public function getSocialXbox()
    {
        return $this->socialXbox;
    }

    /**
     * Sets the socialXbox
     *
     * @param string $socialXbox
     * @return void
     */
    public function setSocialXbox(string $socialXbox)
    {
        $this->socialXbox = $socialXbox;
    }

    /**
     * Returns the socialPsn
     *
     * @return string
     */
    public function getSocialPsn()
    {
        return $this->socialPsn;
    }

    /**
     * Sets the socialPsn
     *
     * @param string $socialPsn
     * @return void
     */
    public function setSocialPsn(string $socialPsn)
    {
        $this->socialPsn = $socialPsn;
    }

    /**
     * Returns the socialNintendo
     *
     * @return string
     */
    public function getSocialNintendo()
    {
        return $this->socialNintendo;
    }

    /**
     * Sets the socialNintendo
     *
     * @param string $socialNintendo
     * @return void
     */
    public function setSocialNintendo(string $socialNintendo)
    {
        $this->socialNintendo = $socialNintendo;
    }

    /**
     * Returns the socialXing
     *
     * @return string
     */
    public function getSocialXing()
    {
        return $this->socialXing;
    }

    /**
     * Sets the socialXing
     *
     * @param string $socialXing
     * @return void
     */
    public function setSocialXing(string $socialXing)
    {
        $this->socialXing = $socialXing;
    }

    /**
     * Adds a FrontendUser
     *
     * @param \Weisgerber\Forums\Domain\Model\FrontendUser $blacklistedUser
     * @return void
     */
    public function addBlacklistedUser(\Weisgerber\Forums\Domain\Model\FrontendUser $blacklistedUser)
    {
        $this->blacklistedUsers->attach($blacklistedUser);
    }

    /**
     * Removes a FrontendUser
     *
     * @param \Weisgerber\Forums\Domain\Model\FrontendUser $blacklistedUserToRemove The FrontendUser to be removed
     * @return void
     */
    public function removeBlacklistedUser(\Weisgerber\Forums\Domain\Model\FrontendUser $blacklistedUserToRemove)
    {
        $this->blacklistedUsers->detach($blacklistedUserToRemove);
    }

    /**
     * Returns the blacklistedUsers
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\FrontendUser>
     */
    public function getBlacklistedUsers()
    {
        return $this->blacklistedUsers;
    }

    /**
     * Sets the blacklistedUsers
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\FrontendUser> $blacklistedUsers
     * @return void
     */
    public function setBlacklistedUsers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $blacklistedUsers)
    {
        $this->blacklistedUsers = $blacklistedUsers;
    }

    /**
     * Returns the threadsPerPage
     *
     * @return int
     */
    public function getThreadsPerPage()
    {
        return $this->threadsPerPage;
    }

    /**
     * Sets the threadsPerPage
     *
     * @param int $threadsPerPage
     * @return void
     */
    public function setThreadsPerPage(int $threadsPerPage)
    {
        $this->threadsPerPage = $threadsPerPage;
    }

    /**
     * Returns the postsPerPage
     *
     * @return int
     */
    public function getPostsPerPage()
    {
        return $this->postsPerPage;
    }

    /**
     * Sets the postsPerPage
     *
     * @param int $postsPerPage
     * @return void
     */
    public function setPostsPerPage(int $postsPerPage)
    {
        $this->postsPerPage = $postsPerPage;
    }

    /**
     * Returns the subscribeToThreadAfterReply
     *
     * @return bool
     */
    public function getSubscribeToThreadAfterReply()
    {
        return $this->subscribeToThreadAfterReply;
    }

    /**
     * Sets the subscribeToThreadAfterReply
     *
     * @param bool $subscribeToThreadAfterReply
     * @return void
     */
    public function setSubscribeToThreadAfterReply(bool $subscribeToThreadAfterReply)
    {
        $this->subscribeToThreadAfterReply = $subscribeToThreadAfterReply;
    }

    /**
     * Returns the boolean state of subscribeToThreadAfterReply
     *
     * @return bool
     */
    public function isSubscribeToThreadAfterReply()
    {
        return $this->subscribeToThreadAfterReply;
    }

    /**
     * Returns the allowDisplayEmail
     *
     * @return bool
     */
    public function getAllowDisplayEmail()
    {
        return $this->allowDisplayEmail;
    }

    /**
     * Sets the allowDisplayEmail
     *
     * @param bool $allowDisplayEmail
     * @return void
     */
    public function setAllowDisplayEmail(bool $allowDisplayEmail)
    {
        $this->allowDisplayEmail = $allowDisplayEmail;
    }

    /**
     * Returns the boolean state of allowDisplayEmail
     *
     * @return bool
     */
    public function isAllowDisplayEmail()
    {
        return $this->allowDisplayEmail;
    }

    /**
     * Returns the cachedCounterPosts
     *
     * @return int
     */
    public function getCachedCounterPosts()
    {
        return $this->cachedCounterPosts;
    }

    /**
     * Sets the cachedCounterPosts
     *
     * @param int $cachedCounterPosts
     * @return void
     */
    public function setCachedCounterPosts(int $cachedCounterPosts)
    {
        $this->cachedCounterPosts = $cachedCounterPosts;
    }

    /**
     * Returns the avatar
     *
     * @return \Weisgerber\Forums\Domain\Model\Avatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Sets the avatar
     *
     * @param \Weisgerber\Forums\Domain\Model\Avatar $avatar
     * @return void
     */
    public function setAvatar(\Weisgerber\Forums\Domain\Model\Avatar $avatar)
    {
        $this->avatar = $avatar;
    }
}
