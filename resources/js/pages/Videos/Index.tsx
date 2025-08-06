import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';
import { PageProps } from '@/types';

type Video = {
    id: number;
    title: string;
    description: string | null;
    video_url: string;
    created_at: string;
};

type VideosPageProps = PageProps & {
    videos: Video[];
};

export default function Index({ auth, videos }: VideosPageProps) {
    return (
        <AppLayout>
            <Head title="Videos" />

            <header className="bg-white shadow">
                <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        Videos
                    </h2>
                </div>
            </header>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            You have access to <span className="font-bold">{videos.length}</span> videos.
                        </div>
                    </div>

                    <div className="mt-6 grid gap-6 lg:grid-cols-3 md:grid-cols-2">
                        {videos.map((video) => (
                            <div key={video.id} className="bg-white p-6 shadow-sm rounded-lg">
                                {/* Di sini kita bisa embed video, misal dari YouTube */}
                                <div className="aspect-w-16 aspect-h-9 mb-4">
                                    {/* Ganti dengan komponen player yang lebih baik untuk produksi */}
                                    <iframe
                                        src={video.video_url.replace('watch?v=', 'embed/')}
                                        frameBorder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowFullScreen
                                        className="w-full h-full rounded-md"
                                    ></iframe>
                                </div>
                                <h3 className="text-lg font-bold text-gray-900">
                                    {video.title}
                                </h3>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
