import { useEffect } from 'react';

export default function LoginSuccess() {
    useEffect(() => {
        const hash = window.location.hash.substring(1); // Menghapus tanda '#'
        const token = hash.startsWith('token=') ? hash.substring(6) : hash; // Mendukung format #token=<token> dan #<token>
        if (token) {
            localStorage.setItem('auth_token', token);
            // You might want to set a timeout or a state to show a success message
            // before redirecting.
            window.location.href = '/dashboard';
        } else {
            // Handle cases where there is no token
            window.location.href = '/login?error=login_failed';
        }
    }, []);

    return <div>Processing login...</div>;
}