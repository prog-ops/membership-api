import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { PageProps } from '@/types';
import { BookOpen, Video } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

type DashboardPageProps = PageProps & {
    articleCount: number;
    videoCount: number;
};

export default function Dashboard({ auth, articleCount, videoCount }: DashboardPageProps) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {/* Kartu Sambutan Utama */}
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div className="p-6 text-gray-900">
                            Welcome back, <span className="font-semibold">{auth.user.name}</span>!
                        </div>
                    </div>

                    {/* Kartu Hak Akses */}
                    <div className="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-8 rounded-xl shadow-lg">
                        <h2 className="text-2xl font-bold mb-2">Your Membership Access</h2>
                        <p className="text-blue-100 mb-6">
                            Here is a summary of the content you can access with your <strong>Type {auth.user.membership_type}</strong> membership.
                        </p>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {/* Card untuk Artikel */}
                            <div className="bg-white/20 backdrop-blur-sm p-6 rounded-lg flex items-center space-x-4">
                                <BookOpen className="w-10 h-10 text-white" />
                                <div>
                                    <p className="text-3xl font-bold">{articleCount}</p>
                                    <p className="text-blue-200">Articles</p>
                                </div>
                            </div>

                            {/* Card untuk Video */}
                            <div className="bg-white/20 backdrop-blur-sm p-6 rounded-lg flex items-center space-x-4">
                                <Video className="w-10 h-10 text-white" />
                                <div>
                                    <p className="text-3xl font-bold">{videoCount}</p>
                                    <p className="text-blue-200">Videos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
