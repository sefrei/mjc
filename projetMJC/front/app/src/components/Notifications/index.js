/*
 * Show notifications
 */

/*
 * Npm import
 */
import React from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';
import { Link } from 'react-router-dom';

/*
 * Local import
 */

/*
 * Code
 */
const Notifications = ({ notifications, displayNotifications, actions }) => {
  console.error(notifications);
  // Go on the activity of the notification
  const onClick = (evt) => {
    actions.changeNotificationState(evt);
  };
  // Get only notif which are active (notif.state === true)
  const notificationsNotRead = notifications.filter((notif) => {
    if (!notif.is_read) {
      return notif;
    }
    return null;
  });
  console.log(notificationsNotRead);
  return (
    <div id="notifications">
      <div onClick={actions.displayNotifications} id="notifications-counter">
        <i
          className={classNames(
            'fa fa-globe',
            { 'active-counter': displayNotifications },
            )}
          id="notifications-counter-icon"
          aria-hidden="true"
        />
        <div id="notifications-counter-count">
          {notificationsNotRead.length}
        </div>
      </div>
      <div
        id="notifications-messages-container"
        className={classNames(
        { 'hide-notif': !displayNotifications },
        )}
      >
        <div id="notifications-messages">
          <div className="triangle" />
          <h1 id="notifications-title">Notifications :</h1>
          {notifications.map((notif) => {
            console.error(notif);
            if (!notif.is_read) {
              return (
                <p className="notif" key={notif.activity_id} onClick={() => onClick(notif.activity_id)} >
                  <Link
                    to={`/ProjectMJC/projetMJC/web/app_dev.php/activity/${notif.id_activity}`}
                  >
                    {notif.message}
                  </Link>
                  <i className="fa fa-times close-notif" aria-hidden="true" />
                </p>
              );
            }
            return null;
          })}
          <p>Tout marquer comme vu</p>
        </div>
      </div>
    </div>
  );
};

/*
 * PropTypes
 */
Notifications.propTypes = {
  notifications: PropTypes.arrayOf(PropTypes.object.isRequired).isRequired,
  displayNotifications: PropTypes.bool.isRequired,
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
};

/*
 * Export default
 */
export default Notifications;
