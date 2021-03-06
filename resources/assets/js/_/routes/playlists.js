import Playlist from '../components/pages/user/playlist/Playlist.vue';

export default [
    {
        path: '/playlists',
        component: Playlist,
        name: 'playlists',
        meta: { onlyAuth: true },
    },
    {
        path: '/playlist/:id',
        component: Playlist,
        name: 'playlist',
        meta: { onlyAuth: true },
    },
];
