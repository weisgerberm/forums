<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Mark Weisgerber <mark.weisgerber@outlook.de>
 */
class FrontendUserTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Domain\Model\FrontendUser|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Weisgerber\Forums\Domain\Model\FrontendUser::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getLastActivityReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getLastActivity()
        );
    }

    /**
     * @test
     */
    public function setLastActivityForDateTimeSetsLastActivity(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setLastActivity($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('lastActivity'));
    }

    /**
     * @test
     */
    public function getProfileVisitsReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getProfileVisits()
        );
    }

    /**
     * @test
     */
    public function setProfileVisitsForIntSetsProfileVisits(): void
    {
        $this->subject->setProfileVisits(12);

        self::assertEquals(12, $this->subject->_get('profileVisits'));
    }

    /**
     * @test
     */
    public function getSocialFacebookReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSocialFacebook()
        );
    }

    /**
     * @test
     */
    public function setSocialFacebookForStringSetsSocialFacebook(): void
    {
        $this->subject->setSocialFacebook('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('socialFacebook'));
    }

    /**
     * @test
     */
    public function getSocialInstagramReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSocialInstagram()
        );
    }

    /**
     * @test
     */
    public function setSocialInstagramForStringSetsSocialInstagram(): void
    {
        $this->subject->setSocialInstagram('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('socialInstagram'));
    }

    /**
     * @test
     */
    public function getSocialPinterestReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSocialPinterest()
        );
    }

    /**
     * @test
     */
    public function setSocialPinterestForStringSetsSocialPinterest(): void
    {
        $this->subject->setSocialPinterest('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('socialPinterest'));
    }

    /**
     * @test
     */
    public function getSocialTwitterReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSocialTwitter()
        );
    }

    /**
     * @test
     */
    public function setSocialTwitterForStringSetsSocialTwitter(): void
    {
        $this->subject->setSocialTwitter('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('socialTwitter'));
    }

    /**
     * @test
     */
    public function getSocialYoutubeReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSocialYoutube()
        );
    }

    /**
     * @test
     */
    public function setSocialYoutubeForStringSetsSocialYoutube(): void
    {
        $this->subject->setSocialYoutube('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('socialYoutube'));
    }

    /**
     * @test
     */
    public function getPreferedTimezoneReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getPreferedTimezone()
        );
    }

    /**
     * @test
     */
    public function setPreferedTimezoneForStringSetsPreferedTimezone(): void
    {
        $this->subject->setPreferedTimezone('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('preferedTimezone'));
    }

    /**
     * @test
     */
    public function getAllowEmailNewsReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getAllowEmailNews());
    }

    /**
     * @test
     */
    public function setAllowEmailNewsForBoolSetsAllowEmailNews(): void
    {
        $this->subject->setAllowEmailNews(true);

        self::assertEquals(true, $this->subject->_get('allowEmailNews'));
    }

    /**
     * @test
     */
    public function getAllowShowOnlineStatusReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getAllowShowOnlineStatus());
    }

    /**
     * @test
     */
    public function setAllowShowOnlineStatusForBoolSetsAllowShowOnlineStatus(): void
    {
        $this->subject->setAllowShowOnlineStatus(true);

        self::assertEquals(true, $this->subject->_get('allowShowOnlineStatus'));
    }

    /**
     * @test
     */
    public function getSocialSteamReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSocialSteam()
        );
    }

    /**
     * @test
     */
    public function setSocialSteamForStringSetsSocialSteam(): void
    {
        $this->subject->setSocialSteam('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('socialSteam'));
    }

    /**
     * @test
     */
    public function getSocialXboxReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSocialXbox()
        );
    }

    /**
     * @test
     */
    public function setSocialXboxForStringSetsSocialXbox(): void
    {
        $this->subject->setSocialXbox('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('socialXbox'));
    }

    /**
     * @test
     */
    public function getSocialPsnReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSocialPsn()
        );
    }

    /**
     * @test
     */
    public function setSocialPsnForStringSetsSocialPsn(): void
    {
        $this->subject->setSocialPsn('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('socialPsn'));
    }

    /**
     * @test
     */
    public function getSocialNintendoReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSocialNintendo()
        );
    }

    /**
     * @test
     */
    public function setSocialNintendoForStringSetsSocialNintendo(): void
    {
        $this->subject->setSocialNintendo('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('socialNintendo'));
    }

    /**
     * @test
     */
    public function getSocialXingReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSocialXing()
        );
    }

    /**
     * @test
     */
    public function setSocialXingForStringSetsSocialXing(): void
    {
        $this->subject->setSocialXing('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('socialXing'));
    }

    /**
     * @test
     */
    public function getThreadsPerPageReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getThreadsPerPage()
        );
    }

    /**
     * @test
     */
    public function setThreadsPerPageForIntSetsThreadsPerPage(): void
    {
        $this->subject->setThreadsPerPage(12);

        self::assertEquals(12, $this->subject->_get('threadsPerPage'));
    }

    /**
     * @test
     */
    public function getPostsPerPageReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getPostsPerPage()
        );
    }

    /**
     * @test
     */
    public function setPostsPerPageForIntSetsPostsPerPage(): void
    {
        $this->subject->setPostsPerPage(12);

        self::assertEquals(12, $this->subject->_get('postsPerPage'));
    }

    /**
     * @test
     */
    public function getSubscribeToThreadAfterReplyReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getSubscribeToThreadAfterReply());
    }

    /**
     * @test
     */
    public function setSubscribeToThreadAfterReplyForBoolSetsSubscribeToThreadAfterReply(): void
    {
        $this->subject->setSubscribeToThreadAfterReply(true);

        self::assertEquals(true, $this->subject->_get('subscribeToThreadAfterReply'));
    }

    /**
     * @test
     */
    public function getAllowDisplayEmailReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getAllowDisplayEmail());
    }

    /**
     * @test
     */
    public function setAllowDisplayEmailForBoolSetsAllowDisplayEmail(): void
    {
        $this->subject->setAllowDisplayEmail(true);

        self::assertEquals(true, $this->subject->_get('allowDisplayEmail'));
    }

    /**
     * @test
     */
    public function getCachedCounterPostsReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getCachedCounterPosts()
        );
    }

    /**
     * @test
     */
    public function setCachedCounterPostsForIntSetsCachedCounterPosts(): void
    {
        $this->subject->setCachedCounterPosts(12);

        self::assertEquals(12, $this->subject->_get('cachedCounterPosts'));
    }

    /**
     * @test
     */
    public function getPostsReturnsInitialValueForPost(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getPosts()
        );
    }

    /**
     * @test
     */
    public function setPostsForObjectStorageContainingPostSetsPosts(): void
    {
        $post = new \Weisgerber\Forums\Domain\Model\Post();
        $objectStorageHoldingExactlyOnePosts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOnePosts->attach($post);
        $this->subject->setPosts($objectStorageHoldingExactlyOnePosts);

        self::assertEquals($objectStorageHoldingExactlyOnePosts, $this->subject->_get('posts'));
    }

    /**
     * @test
     */
    public function addPostToObjectStorageHoldingPosts(): void
    {
        $post = new \Weisgerber\Forums\Domain\Model\Post();
        $postsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $postsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($post));
        $this->subject->_set('posts', $postsObjectStorageMock);

        $this->subject->addPost($post);
    }

    /**
     * @test
     */
    public function removePostFromObjectStorageHoldingPosts(): void
    {
        $post = new \Weisgerber\Forums\Domain\Model\Post();
        $postsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $postsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($post));
        $this->subject->_set('posts', $postsObjectStorageMock);

        $this->subject->removePost($post);
    }

    /**
     * @test
     */
    public function getThreadSubscriptionsReturnsInitialValueForThreadSubscription(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getThreadSubscriptions()
        );
    }

    /**
     * @test
     */
    public function setThreadSubscriptionsForObjectStorageContainingThreadSubscriptionSetsThreadSubscriptions(): void
    {
        $threadSubscription = new \Weisgerber\Forums\Domain\Model\ThreadSubscription();
        $objectStorageHoldingExactlyOneThreadSubscriptions = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneThreadSubscriptions->attach($threadSubscription);
        $this->subject->setThreadSubscriptions($objectStorageHoldingExactlyOneThreadSubscriptions);

        self::assertEquals($objectStorageHoldingExactlyOneThreadSubscriptions, $this->subject->_get('threadSubscriptions'));
    }

    /**
     * @test
     */
    public function addThreadSubscriptionToObjectStorageHoldingThreadSubscriptions(): void
    {
        $threadSubscription = new \Weisgerber\Forums\Domain\Model\ThreadSubscription();
        $threadSubscriptionsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $threadSubscriptionsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($threadSubscription));
        $this->subject->_set('threadSubscriptions', $threadSubscriptionsObjectStorageMock);

        $this->subject->addThreadSubscription($threadSubscription);
    }

    /**
     * @test
     */
    public function removeThreadSubscriptionFromObjectStorageHoldingThreadSubscriptions(): void
    {
        $threadSubscription = new \Weisgerber\Forums\Domain\Model\ThreadSubscription();
        $threadSubscriptionsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $threadSubscriptionsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($threadSubscription));
        $this->subject->_set('threadSubscriptions', $threadSubscriptionsObjectStorageMock);

        $this->subject->removeThreadSubscription($threadSubscription);
    }

    /**
     * @test
     */
    public function getSignaturesReturnsInitialValueForSignature(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getSignatures()
        );
    }

    /**
     * @test
     */
    public function setSignaturesForObjectStorageContainingSignatureSetsSignatures(): void
    {
        $signature = new \Weisgerber\Forums\Domain\Model\Signature();
        $objectStorageHoldingExactlyOneSignatures = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneSignatures->attach($signature);
        $this->subject->setSignatures($objectStorageHoldingExactlyOneSignatures);

        self::assertEquals($objectStorageHoldingExactlyOneSignatures, $this->subject->_get('signatures'));
    }

    /**
     * @test
     */
    public function addSignatureToObjectStorageHoldingSignatures(): void
    {
        $signature = new \Weisgerber\Forums\Domain\Model\Signature();
        $signaturesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $signaturesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($signature));
        $this->subject->_set('signatures', $signaturesObjectStorageMock);

        $this->subject->addSignature($signature);
    }

    /**
     * @test
     */
    public function removeSignatureFromObjectStorageHoldingSignatures(): void
    {
        $signature = new \Weisgerber\Forums\Domain\Model\Signature();
        $signaturesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $signaturesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($signature));
        $this->subject->_set('signatures', $signaturesObjectStorageMock);

        $this->subject->removeSignature($signature);
    }

    /**
     * @test
     */
    public function getPostLikesReturnsInitialValueForPostLike(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getPostLikes()
        );
    }

    /**
     * @test
     */
    public function setPostLikesForObjectStorageContainingPostLikeSetsPostLikes(): void
    {
        $postLike = new \Weisgerber\Forums\Domain\Model\PostLike();
        $objectStorageHoldingExactlyOnePostLikes = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOnePostLikes->attach($postLike);
        $this->subject->setPostLikes($objectStorageHoldingExactlyOnePostLikes);

        self::assertEquals($objectStorageHoldingExactlyOnePostLikes, $this->subject->_get('postLikes'));
    }

    /**
     * @test
     */
    public function addPostLikeToObjectStorageHoldingPostLikes(): void
    {
        $postLike = new \Weisgerber\Forums\Domain\Model\PostLike();
        $postLikesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $postLikesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($postLike));
        $this->subject->_set('postLikes', $postLikesObjectStorageMock);

        $this->subject->addPostLike($postLike);
    }

    /**
     * @test
     */
    public function removePostLikeFromObjectStorageHoldingPostLikes(): void
    {
        $postLike = new \Weisgerber\Forums\Domain\Model\PostLike();
        $postLikesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $postLikesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($postLike));
        $this->subject->_set('postLikes', $postLikesObjectStorageMock);

        $this->subject->removePostLike($postLike);
    }

    /**
     * @test
     */
    public function getPollVotesReturnsInitialValueForPollVote(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getPollVotes()
        );
    }

    /**
     * @test
     */
    public function setPollVotesForObjectStorageContainingPollVoteSetsPollVotes(): void
    {
        $pollVote = new \Weisgerber\Forums\Domain\Model\PollVote();
        $objectStorageHoldingExactlyOnePollVotes = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOnePollVotes->attach($pollVote);
        $this->subject->setPollVotes($objectStorageHoldingExactlyOnePollVotes);

        self::assertEquals($objectStorageHoldingExactlyOnePollVotes, $this->subject->_get('pollVotes'));
    }

    /**
     * @test
     */
    public function addPollVoteToObjectStorageHoldingPollVotes(): void
    {
        $pollVote = new \Weisgerber\Forums\Domain\Model\PollVote();
        $pollVotesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $pollVotesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($pollVote));
        $this->subject->_set('pollVotes', $pollVotesObjectStorageMock);

        $this->subject->addPollVote($pollVote);
    }

    /**
     * @test
     */
    public function removePollVoteFromObjectStorageHoldingPollVotes(): void
    {
        $pollVote = new \Weisgerber\Forums\Domain\Model\PollVote();
        $pollVotesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $pollVotesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($pollVote));
        $this->subject->_set('pollVotes', $pollVotesObjectStorageMock);

        $this->subject->removePollVote($pollVote);
    }

    /**
     * @test
     */
    public function getFriendsReturnsInitialValueForFrontendUser(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getFriends()
        );
    }

    /**
     * @test
     */
    public function setFriendsForObjectStorageContainingFrontendUserSetsFriends(): void
    {
        $friend = new \Weisgerber\Forums\Domain\Model\FrontendUser();
        $objectStorageHoldingExactlyOneFriends = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneFriends->attach($friend);
        $this->subject->setFriends($objectStorageHoldingExactlyOneFriends);

        self::assertEquals($objectStorageHoldingExactlyOneFriends, $this->subject->_get('friends'));
    }

    /**
     * @test
     */
    public function addFriendToObjectStorageHoldingFriends(): void
    {
        $friend = new \Weisgerber\Forums\Domain\Model\FrontendUser();
        $friendsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $friendsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($friend));
        $this->subject->_set('friends', $friendsObjectStorageMock);

        $this->subject->addFriend($friend);
    }

    /**
     * @test
     */
    public function removeFriendFromObjectStorageHoldingFriends(): void
    {
        $friend = new \Weisgerber\Forums\Domain\Model\FrontendUser();
        $friendsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $friendsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($friend));
        $this->subject->_set('friends', $friendsObjectStorageMock);

        $this->subject->removeFriend($friend);
    }

    /**
     * @test
     */
    public function getPrivateMessagesReturnsInitialValueForPrivateMessage(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getPrivateMessages()
        );
    }

    /**
     * @test
     */
    public function setPrivateMessagesForObjectStorageContainingPrivateMessageSetsPrivateMessages(): void
    {
        $privateMessage = new \Weisgerber\Forums\Domain\Model\PrivateMessage();
        $objectStorageHoldingExactlyOnePrivateMessages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOnePrivateMessages->attach($privateMessage);
        $this->subject->setPrivateMessages($objectStorageHoldingExactlyOnePrivateMessages);

        self::assertEquals($objectStorageHoldingExactlyOnePrivateMessages, $this->subject->_get('privateMessages'));
    }

    /**
     * @test
     */
    public function addPrivateMessageToObjectStorageHoldingPrivateMessages(): void
    {
        $privateMessage = new \Weisgerber\Forums\Domain\Model\PrivateMessage();
        $privateMessagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $privateMessagesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($privateMessage));
        $this->subject->_set('privateMessages', $privateMessagesObjectStorageMock);

        $this->subject->addPrivateMessage($privateMessage);
    }

    /**
     * @test
     */
    public function removePrivateMessageFromObjectStorageHoldingPrivateMessages(): void
    {
        $privateMessage = new \Weisgerber\Forums\Domain\Model\PrivateMessage();
        $privateMessagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $privateMessagesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($privateMessage));
        $this->subject->_set('privateMessages', $privateMessagesObjectStorageMock);

        $this->subject->removePrivateMessage($privateMessage);
    }

    /**
     * @test
     */
    public function getBlacklistedUsersReturnsInitialValueForFrontendUser(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getBlacklistedUsers()
        );
    }

    /**
     * @test
     */
    public function setBlacklistedUsersForObjectStorageContainingFrontendUserSetsBlacklistedUsers(): void
    {
        $blacklistedUser = new \Weisgerber\Forums\Domain\Model\FrontendUser();
        $objectStorageHoldingExactlyOneBlacklistedUsers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneBlacklistedUsers->attach($blacklistedUser);
        $this->subject->setBlacklistedUsers($objectStorageHoldingExactlyOneBlacklistedUsers);

        self::assertEquals($objectStorageHoldingExactlyOneBlacklistedUsers, $this->subject->_get('blacklistedUsers'));
    }

    /**
     * @test
     */
    public function addBlacklistedUserToObjectStorageHoldingBlacklistedUsers(): void
    {
        $blacklistedUser = new \Weisgerber\Forums\Domain\Model\FrontendUser();
        $blacklistedUsersObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $blacklistedUsersObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($blacklistedUser));
        $this->subject->_set('blacklistedUsers', $blacklistedUsersObjectStorageMock);

        $this->subject->addBlacklistedUser($blacklistedUser);
    }

    /**
     * @test
     */
    public function removeBlacklistedUserFromObjectStorageHoldingBlacklistedUsers(): void
    {
        $blacklistedUser = new \Weisgerber\Forums\Domain\Model\FrontendUser();
        $blacklistedUsersObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $blacklistedUsersObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($blacklistedUser));
        $this->subject->_set('blacklistedUsers', $blacklistedUsersObjectStorageMock);

        $this->subject->removeBlacklistedUser($blacklistedUser);
    }

    /**
     * @test
     */
    public function getAvatarReturnsInitialValueForAvatar(): void
    {
        self::assertEquals(
            null,
            $this->subject->getAvatar()
        );
    }

    /**
     * @test
     */
    public function setAvatarForAvatarSetsAvatar(): void
    {
        $avatarFixture = new \Weisgerber\Forums\Domain\Model\Avatar();
        $this->subject->setAvatar($avatarFixture);

        self::assertEquals($avatarFixture, $this->subject->_get('avatar'));
    }
}
