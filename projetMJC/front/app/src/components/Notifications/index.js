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
  const onClick = (evt) => {
    actions.changeNotificationState(evt);
  };
  const notificationsNotRead = notifications.filter((notif) => {
    if (notif.state) {
      return notif;
    }
    return null;
  });
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
          <div className="triangle"></div>
          <h1 id="notifications-title">Notifications :</h1>
          {notifications.map((notif) => {
            if (notif.state) {
              return (
                <p className="notif" key={notif.id} onClick={() => onClick(notif.id)} >
                  <Link
                    to={`/ProjectMJC/projetMJC/web/app_dev.php/activity/${notif.id_activity}`}
                  >
                    - {notif.message}
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
Notifications.propTypes = {
  notifications: PropTypes.arrayOf(PropTypes.object.isRequired).isRequired,
  displayNotifications: PropTypes.bool.isRequired,
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
};

/*
 * Export default
 */
export default Notifications;
