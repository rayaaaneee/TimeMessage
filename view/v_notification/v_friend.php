<head>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>notification/friend.css">
</head>
<?php require_once(PATH_VIEWS_PARTS . 'error.php') ?>
<div class="notifications-container">
    <?php foreach ($notificationsFriends as $notification) : ?>
        <?php if ($indexNotification > 0) : ?>
            <div class="separator-bar"></div>
        <?php endif; ?>
        <?php if ($notification->getType() == NotificationType::FRIEND_REQUEST) : ?>
            <div class="friend-request-notification notification">
                <div class="is-new">
                    <div class="red-point"></div>
                </div>
                <div class="profile-picture-container">
                    <a href="./?page=profile&user=<?= $notification->getUserSender()->getId(); ?>">
                        <img src="<?= $notification->getUserSender()->getProfilePicturePath(); ?>" alt="Profile picture" draggable="false">
                    </a>
                </div>
                <div class="user-informations">
                    <div class="flex-row">
                        <p class="username">@<?= $notification->getUserSender()->getUsername(); ?></p>
                        <p class="name">sent you a friend request</p>
                    </div>
                    <?php if ($notification->getUserSender()->isPublic()) : ?>
                        <p class="public">This user is public</p>
                    <?php else : ?>
                        <p class="private">This user is private</p>
                    <?php endif; ?>
                    <p class="date"><?= $notification->getTextDate() ?></p>
                </div>
                <form action="./?page=notification&part=friend" method="post" class="accept-decline-request-form">
                    <button type="submit" name="accept-request" class="accept-request" title="Accept friend request">
                        <img src="<?= PATH_IMG_PAGES; ?>notification/accept.png" alt="Accept">
                    </button>
                    <button type="submit" name="decline-request" class="decline-request" title="Decline friend request">
                        <img src="<?= PATH_IMG_PAGES; ?>notification/decline.png" alt="Decline">
                    </button>
                </form>
            </div>
        <?php elseif ($notification->getType() == NotificationType::FRIEND_REQUEST_ACCEPTED) : ?>
            <div class="friend-request-accepted-notification notification">
                <div class="profile-picture-container">
                    <img src="<?= $notification->getUserSender()->getProfilePicturePath(); ?>" alt="Profile picture">
                </div>
                <div class="user-informations">
                    <p class="username"><?= $notification->getUserSender()->getUsername(); ?></p>
                    <?php if ($notification->getUserSender()->isPublic()) : ?>
                        <p class="public">Public</p>
                    <?php else : ?>
                        <p class="private">Privé</p>
                    <?php endif; ?>
                    <p class="date"><?= $notification->getTextDate() ?></p>
                </div>
                <form action="./?page=notification&part=friend" method="post">
                    <button type="submit" name="accept">Accepter</button>
                    <button type="submit" name="decline">Refuser</button>
                </form>
            </div>
        <?php elseif ($notification->getType() == NotificationType::FRIEND_REQUEST_DECLINED) : ?>
            <div class="friend-request-declined-notification notification">
                <div class="profile-picture-container">
                    <img src="<?= $notification->getUserSender()->getProfilePicturePath(); ?>" alt="Profile picture">
                </div>
                <div class="user-informations">
                    <p class="username"><?= $notification->getUserSender()->getUsername(); ?></p>
                    <?php if ($notification->getUserSender()->isPublic()) : ?>
                        <p class="public">Public</p>
                    <?php else : ?>
                        <p class="private">Privé</p>
                    <?php endif; ?>
                    <p class="date"><?= $notification->getTextDate() ?></p>
                </div>
                <form action="./?page=notification&part=friend" method="post">
                    <button type="submit" name="accept">Accepter</button>
                    <button type="submit" name="decline">Refuser</button>
                </form>
            </div>
        <?php endif; ?>
        <?php $indexNotification++; ?>
    <?php endforeach; ?>
</div>